<?php

namespace App\Service\SyncService;

use App\Api\MotionSoft\Model\MemberModel;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Http\Response;
use SevenShores\Hubspot\Resources\Contacts;
use Throwable;

class Update
{
    /**
     * @var SyncProperties
     */
    private $syncProperties;
    /**
     * @var Create
     */
    private $create;
    /**
     * @var CreateDeals
     */
    private $createDeals;

    /**
     * @param SyncProperties $syncProperties
     * @param Create $create
     */
    public function __construct(SyncProperties $syncProperties, Create $create, CreateDeals $createDeals)
    {
        $this->syncProperties = $syncProperties;
        $this->create = $create;
        $this->createDeals = $createDeals;
    }

    /**
     * @param string $hubspotId
     * @param MemberModel $member
     * @return void
     * @throws GuzzleException
     * @throws Exception
     */
    public function syncHubSpotContactWithMember(string $hubspotId, MemberModel $member)
    {
        $properties = $this->syncProperties->getSyncProperties($member);
        try {

            $contactResponse = $this->updateContact($hubspotId, $properties);

            $this->createDeals->createDealsFromMember($hubspotId, $member);

        } catch (Throwable $t) {
            error_log("An error occurred. {$t->getMessage()}");
            if ($t->getCode() === 404) {
                $this->create->createHubSpotContactFromMember($member);
                return;
            }
        }
    }

    /**
     * @param string $hubspotId
     * @param array $properties
     * @return Response
     */
    private function updateContact(string $hubspotId, array $properties): Response
    {
        $client = new Client(['key' => env('HUBSPOT_API_KEY')]);
        $contactRequest = new Contacts($client);
        return $contactRequest->update($hubspotId, $properties);
    }
}
