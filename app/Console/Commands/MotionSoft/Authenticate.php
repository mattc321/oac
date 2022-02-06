<?php

namespace App\Console\Commands\MotionSoft;

use App\Api\MotionSoft\Members\GetMemberLedgerIterator;
use App\Api\MotionSoft\Members\GetMemberSearchIterator;
use App\Api\MotionSoft\Model\MemberModel;
use App\Api\MotionSoft\MotionSoftClient;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use SevenShores\Hubspot\Resources\ContactProperties;
use SevenShores\Hubspot\Resources\Contacts;
use SevenShores\Hubspot\Resources\Engagements;

class Authenticate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'motionsoft:authenticate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Authenticate the motionsoft api client';
    /**
     * @var GetMemberSearchIterator
     */
    private $getMemberSearchIterator;
    /**
     * @var GetMemberLedgerIterator
     */
    private $memberLedgerIterator;
    /**
     * @var MotionSoftClient
     */
    private $motionSoftClient;

    /**
     * Create a new command instance.
     *
     * @param GetMemberSearchIterator $getMemberSearchIterator
     */
    public function __construct(GetMemberSearchIterator $getMemberSearchIterator, GetMemberLedgerIterator $memberLedgerIterator, MotionSoftClient $motionSoftClient)
    {
        parent::__construct();
        $this->getMemberSearchIterator = $getMemberSearchIterator;
        $this->memberLedgerIterator = $memberLedgerIterator;
        $this->motionSoftClient = $motionSoftClient;
    }

    /**
     * @return void
     * @throws Exception
     */
    public function handle()
    {
//  ->>>>>>>>>>>      figure out how to import sales history to hubspot
        $this->createOrUpdateMembersInHubSpot();

//        $client = new \SevenShores\Hubspot\Http\Client(['key' => '35f3d6a2-0557-4432-9c26-8b9025400b19']);
//
//        $contactRequest = new Contacts($client);
//        $response = $contactRequest->getByEmail('cascadiamatt@gmail.com');
//
//        foreach ($response->getData()->contacts as $contact) {
//            $firstName = $contact->properties->firstname->value;
//            $lastName = $contact->properties->lastname->value;
//        }
//        $a=1;

    }

    private function createOrUpdateMembersInHubSpot()
    {
        $members = $this->getMemberSearchIterator->getMembers();

        foreach ($members as $member) {
            if ($hubspotId = $member->getSalesperson3()) {
                $this->syncHubSpotContactWithMember($hubspotId, $member);
                continue;
            }

            $this->createHubSpotContactFromMember($member);
        }
    }

    private function getledger()
    {
        $memberId = 102284;
        $psum = 0;
        $nsum = 0;
        foreach ($this->memberLedgerIterator->getEntireLedgerForMember($memberId) as $ledgerEntry) {
            if ($ledgerEntry->getTotal() < 0) {
                $nsum = $nsum + $ledgerEntry->getTotal();
                continue;
            }
            $psum = $psum + $ledgerEntry->getTotal();
        }

        $this->info("PSUM TOTAL: {$psum}");
        $this->info("NSUM TOTAL: {$nsum}");
        $this->info('NET TOTAL: ' . ($psum + $nsum));
    }

    private function getTranslationFields()
    {
        return [
            'Acctnote' => 'acctnote',
            'Address1' => 'address',
            'Birthday' => 'birthday',
            'City' => 'city',
            'Company' => 'company',
            'DoNotSendTextMessages' => 'donotsendtextmessages',
            'DoNotEmail' => 'donotemail',
            'EnteredDate' => 'entereddate',
            'Email' => 'email',
            'FirstName' => 'firstname',
            'Gender' => 'motionsoft_gender',
            'ID' => 'motionsoft_member_id',
            'LastName' => 'lastname',
            'Membership_Type' => 'membership_type',
            'MemberStatus' => 'motionsoft_membership_status',
            'Memo' => 'memo',
            'Phone1' => 'phone',
            'State' => 'state',
            'Zip' => 'zip'
        ];
    }

    private function createContact(array $properties)
    {
        $client = new \SevenShores\Hubspot\Http\Client(['key' => '35f3d6a2-0557-4432-9c26-8b9025400b19']);
        $contactRequest = new Contacts($client);
        return $contactRequest->create($properties);
    }

    private function convertDateToTimeStamp(string $dateToConvert)
    {
        $tz = new \DateTimeZone('UTC');
        $date = new \DateTime($dateToConvert, $tz);
        return $date->getTimestamp()*1000;
    }

    private function createHubSpotContactFromMember(MemberModel $member)
    {
        $properties = $this->getSyncProperties($member);
        try {
            $contactResponse = $this->createContact($properties);
            $vid = $contactResponse->getData()->vid ? $contactResponse->getData()->vid : null;
            if ($vid) {
                $this->motionSoftClient->updateMember(null, ['ID' => $member->getID(), 'SalesPerson3' => $vid]);
                return;
            }
        } catch (\Throwable $t) {
            if ($t->getCode() === 409) {
                $contactResponse = $this->getContactByEmail($member->getEmail());
                $vid = $contactResponse->getData()->vid ? $contactResponse->getData()->vid : null;
                if ($vid) {
                    $this->motionSoftClient->updateMember(null, ['ID' => $member->getID(), 'SalesPerson3' => $vid]);
                    return;
                }
            }
            //email someone cuz none of this worked
        }
    }

    private function getSyncProperties(MemberModel $member)
    {
        $fieldsToSync = $this->getTranslationFields();
        $properties = [];
        foreach ($fieldsToSync as $motionSoftProperty => $hubspotProperty) {
            if ($member->$motionSoftProperty === null || trim($member->$motionSoftProperty) === '') {
                continue;
            }
            $value = $member->$motionSoftProperty;
            if ($hubspotProperty === 'address') {
                $value = "{$member->getAddress1()} {$member->getAddress2()}";
            }
            if ($hubspotProperty === 'birthday' || $hubspotProperty === 'entereddate') {
                $value = $this->convertDateToTimeStamp($member->$motionSoftProperty);
            }
            $properties[] = [
                'property' => $hubspotProperty,
                'value' => $value
            ];
        }
        return $properties;
    }

    private function syncHubSpotContactWithMember(string $hubspotId, MemberModel $member)
    {
        $properties = $this->getSyncProperties($member);
        try {
            $contactResponse = $this->updateContact($hubspotId, $properties);
        } catch (\Throwable $t) {
            if ($t->getCode() === 404) {
                $this->createHubSpotContactFromMember($member);
                return;
            }
            //log the error and email someone
        }
    }

    private function updateContact(string $hubspotId, array $properties)
    {
        $client = new \SevenShores\Hubspot\Http\Client(['key' => '35f3d6a2-0557-4432-9c26-8b9025400b19']);
        $contactRequest = new Contacts($client);
        return $contactRequest->update($hubspotId, $properties);
    }

    private function getContactByEmail(string $email)
    {
        $client = new \SevenShores\Hubspot\Http\Client(['key' => '35f3d6a2-0557-4432-9c26-8b9025400b19']);
        $contactRequest = new Contacts($client);
        return $contactRequest->getByEmail($email);
    }
}
