<?php

namespace App\Api\MotionSoft\Members;

use App\Api\MotionSoft\Model\LedgerEntryModel;
use App\Api\MotionSoft\MotionSoftClient;

class GetMemberLedgerIterator
{
    /**
     * @var MotionSoftClient
     */
    private $client;

    /**
     * @param MotionSoftClient $client
     */
    public function __construct(MotionSoftClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param string|int $memberId
     * @return \Generator|void
     * @throws \Exception
     */
    public function getEntireLedgerForMember($memberId)
    {
        $maxPageCount = 100;
        $pageCount = 0;
        $oldestDate = null;
        $nextStartingDate = null;
        $nextEndingDate = null;
        $idsRan = [];
        $lastStartingDateRan = null;

        while ($pageCount <= $maxPageCount) {

            if ($pageCount === $maxPageCount) {
                throw new \Exception("Reached maximum page count while fetched ledger for {$memberId}. This is probably a problem.");
            }

            $pageCount++;

            error_log("Member ledger pulling page {$pageCount}");

            if ($oldestDate) {
                $nextEndingDate = clone $oldestDate; //duplicate these for modification

                $nextStartingDate = clone $nextEndingDate;
                $nextStartingDate->modify('-1 year')->modify('+1 day');

                if ($lastStartingDateRan == $nextStartingDate) {
                    $nextEndingDate->modify('-1 day');
                    $nextStartingDate->modify('-1 day');
                }

                $lastStartingDateRan = clone $nextStartingDate;
                //we need to do slightly less than a year to prevent failures of requests greater than 1 year
            }

            if ($nextStartingDate && $nextEndingDate) {
                error_log("Member ledger pulling dates {$nextStartingDate->format('Y-m-d')} thru {$nextEndingDate->format('Y-m-d')}");
                $request = $this->client->getMemberLedger($memberId, $nextStartingDate, $nextEndingDate);
            } else {
                error_log("Member ledger pulling YTD");
                $request = $this->client->getMemberLedger($memberId);
            }

            $body = json_decode($request->getBody(), true);

            if (! isset($body['Data'])) {
                throw new \Exception('No results found');
            }

            if (! $body['Data']) {
                error_log("Member search ended on page {$pageCount}");
                return;
            }

            $memberSearchResults = $body['Data'];

            $firstEntry = reset($memberSearchResults);

            if (! isset($firstEntry['Saledate']) || ! $firstEntry['Saledate']) {
                throw new \Exception("Cannot determine the last date to run while fetching ledger. Missing saleDate key.");
            }

            $oldestDate = new \DateTime($firstEntry['Saledate']);
            error_log("Oldest date returned was {$oldestDate->format('Y-m-d')}");

            foreach ($memberSearchResults as $memberLedgerEntry) {
                if (in_array($memberLedgerEntry['TID'], $idsRan)) {
                    continue; //duplicate check;
                }
                $idsRan[] = $memberLedgerEntry['TID'];
                yield new LedgerEntryModel($memberLedgerEntry);
            }
        }
    }
}
