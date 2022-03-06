<?php

namespace App\Service\SyncService;

use App\Api\MotionSoft\Members\GetMemberLedgerIterator;
use App\Api\MotionSoft\Model\MemberModel;
use App\Service\SyncService\Helper\DateTimeConverter;
use App\Service\SyncService\Helper\DealCreator;
use App\Service\SyncService\Helper\LastDealRetriever;
use DateTime;
use Exception;
use GuzzleHttp\Exception\GuzzleException;

class CreateDeals
{
    /**
     * @var GetMemberLedgerIterator
     */
    private $memberLedgerIterator;
    /**
     * @var DealCreator
     */
    private $dealCreator;
    /**
     * @var LastDealRetriever
     */
    private $lastDealRetriever;
    /**
     * @var DateTimeConverter
     */
    private $dateTimeConverter;

    /**
     * @param GetMemberLedgerIterator $memberLedgerIterator
     * @param DealCreator $dealCreator
     * @param LastDealRetriever $lastDealRetriever
     */
    public function __construct(GetMemberLedgerIterator $memberLedgerIterator, DealCreator $dealCreator, LastDealRetriever $lastDealRetriever, DateTimeConverter $dateTimeConverter)
    {
        $this->memberLedgerIterator = $memberLedgerIterator;
        $this->dealCreator = $dealCreator;
        $this->lastDealRetriever = $lastDealRetriever;
        $this->dateTimeConverter = $dateTimeConverter;
    }

    /**
     * @param string|int $hubspotVid
     * @param MemberModel $member
     * @return void
     * @throws Exception
     * @throws GuzzleException
     */
    public function createDealsFromMember($hubspotVid, MemberModel $member)
    {
        if ($lastDealDate = $this->lastDealRetriever->getLastDealDateFromHubSpot($hubspotVid)) {
            $lastDateImported = $this->dateTimeConverter->convertTimeStampToDate($lastDealDate);
            $lastDateImported->modify(('-1 day')); //very annoying hubspot deals in midnights and ms so these dates gets messed up during conversion
            $memberLedger = $this->memberLedgerIterator->getEntireLedgerForMember($member->getID(), $lastDateImported);
        } else {
            $memberLedger = $this->memberLedgerIterator->getEntireLedgerForMember($member->getID());
        }

        $totalPaymentsCreated = 0;
        foreach ($memberLedger as $ledgerEntry) {
            //only sync payments
            if (strtolower($ledgerEntry->getTableName()) !== 'p') {
                continue;
            }
            error_log(
                "Creating deal for
                Name {$member->getFirstName()} {$member->getLastName()}.
                Ledger {$ledgerEntry->getTID()}.
                Amount {$ledgerEntry->getTotal()}.
                MS Date {$ledgerEntry->getSaledate()}"
            );

            $this->dealCreator->createDealForHubSpotContact(
                $hubspotVid,
                $ledgerEntry->getTotal()*-1,
                $ledgerEntry->getSaledate(),
                $ledgerEntry->getTID()
            );
            $totalPaymentsCreated++;
        }
        error_log("{$totalPaymentsCreated} total payments created for {$member->getID()}");
    }
}
