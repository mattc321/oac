<?php

namespace App\Console\Commands\MotionSoft;

use App\Api\MotionSoft\Model\MemberModel;
use App\Api\MotionSoft\MotionSoftClient;
use App\Service\SyncService\Create;
use App\Service\SyncService\Update;
use Illuminate\Console\Command;
use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\CrmAssociations;
use SevenShores\Hubspot\Resources\Deals;

class ReSyncMemberFull extends Command
{
    protected $signature = 'motionsoft:reSyncMemberFull
                            {memberId : The motionsoft member id to delete and reimport into hubspot}';

    protected $description = 'Delete member and deals from hubspot and resync deals.';
    /**
     * @var MotionSoftClient
     */
    private $motionSoftClient;
    /**
     * @var Create
     */
    private $create;
    /**
     * @var Update
     */
    private $update;

    /**
     * @param MotionSoftClient $motionSoftClient
     * @param Create $create
     * @param Update $update
     */
    public function __construct(MotionSoftClient $motionSoftClient, Create $create, Update $update)
    {
        parent::__construct();
        $this->motionSoftClient = $motionSoftClient;
        $this->create = $create;
        $this->update = $update;
    }

    public function handle()
    {

        $memberId = $this->argument('memberId');

        if (! $memberId) {
            $this->error('Must supply a member id to re-sync.');
            return;
        }

        $memberRequest = $this->motionSoftClient->getMemberById($memberId);

        if ($memberRequest->getStatusCode() !== 200) {
            $this->error("Could not retrieve member {$memberId}. Status Code {$memberRequest->getStatusCode()}");
            return;
        }

        $responseBody = json_decode($memberRequest->getBody(), true);

        if (! isset($responseBody['Data'])) {
            $this->error('No data set on response body.');
            return;
        }

        $member = new MemberModel($responseBody['Data']);

        //resync existing contact
        if ($hubspotId = $member->getSalesperson3()) {

            //delete the deals
            $client = new Client(['key' => env('HUBSPOT_API_KEY')]);
            $crmRequest = new CrmAssociations($client);
            $crmResponse = $crmRequest->get($hubspotId,4);
            if ($crmResponse->getData() && isset($crmResponse->getData()->results) && $crmResponse->getData()->results) {
                foreach ($crmResponse->getData()->results as $resultDealId) {
                    $dealRequest = new Deals($client);
                    $dealDeleteRequest = $dealRequest->delete($resultDealId);
                    error_log("Deleting deal {$resultDealId} status code {$dealDeleteRequest->getStatusCode()}");
                }
            }

            //update existing
            error_log("Member {$member->getID()} syncing withing hubspot contact {$hubspotId}");
            $this->update->syncHubSpotContactWithMember($hubspotId, $member);
            return;
        }

        //create new
        error_log("Member {$member->getID()} creating new in hubspot");
        $this->create->createHubSpotContactFromMember($member);
    }
}
