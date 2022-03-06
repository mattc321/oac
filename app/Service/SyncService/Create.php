<?php

namespace App\Service\SyncService;

use App\Api\MotionSoft\Model\MemberModel;
use App\Api\MotionSoft\MotionSoftClient;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Http\Response;
use SevenShores\Hubspot\Resources\Contacts;
use Throwable;

class Create
{
    /**
     * @var SyncProperties
     */
    private $syncProperties;
    /**
     * @var MotionSoftClient
     */
    private $motionSoftClient;
    /**
     * @var CreateDeals
     */
    private $createDeals;

    /**
     * @param SyncProperties $syncProperties
     * @param MotionSoftClient $motionSoftClient
     * @param CreateDeals $createDeals
     */
    public function __construct(SyncProperties $syncProperties, MotionSoftClient $motionSoftClient, CreateDeals $createDeals)
    {
        $this->syncProperties = $syncProperties;
        $this->motionSoftClient = $motionSoftClient;
        $this->createDeals = $createDeals;
    }

    /**
     * @param MemberModel $member
     * @return void
     * @throws GuzzleException
     * @throws Exception
     */
    public function createHubSpotContactFromMember(MemberModel $member)
    {
        $properties = $this->syncProperties->getSyncProperties($member);

        try {

            $contactResponse = $this->createContact($properties);

            $vid = $contactResponse->getData()->vid ? $contactResponse->getData()->vid : null;

            if (! $vid) {
                throw new Exception("Failed trying to create contact for {$member->getEmail()} no vid returned.");
            }

            //update motionsoft with the hubspot vid
            $this->motionSoftClient->updateMember(null, ['ID' => $member->getID(), 'SalesPerson3' => $vid]);

            //create deals in hubspot from contacts ledger
            $this->createDeals->createDealsFromMember($vid, $member);

        } catch (Throwable $t) {

            if ($t->getCode() === 409) {
                //tried to create a contact that already exists. just update its vid for next time.
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

    /**
     * @param array $properties
     * @return Response
     */
    private function createContact(array $properties): Response
    {
        $client = new Client(['key' => env('HUBSPOT_API_KEY')]);
        $contactRequest = new Contacts($client);
        return $contactRequest->create($properties);
    }

    /**
     * @param string $email
     * @return Response
     */
    private function getContactByEmail(string $email): Response
    {
        $client = new Client(['key' => env('HUBSPOT_API_KEY')]);
        $contactRequest = new Contacts($client);
        return $contactRequest->getByEmail($email);
    }
}
