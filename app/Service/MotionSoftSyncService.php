<?php

namespace App\Service;

use App\Api\MotionSoft\Members\GetMemberSearchIterator;
use App\Service\SyncService\Create;
use App\Service\SyncService\Update;
use Exception;
use GuzzleHttp\Exception\GuzzleException;

class MotionSoftSyncService
{
    /**
     * @var GetMemberSearchIterator
     */
    private $getMemberSearchIterator;
    /**
     * @var Update
     */
    private $update;
    /**
     * @var Create
     */
    private $create;

    /**
     * @param GetMemberSearchIterator $getMemberSearchIterator
     * @param Update $update
     * @param Create $create
     */
    public function __construct(GetMemberSearchIterator $getMemberSearchIterator, Update $update, Create $create)
    {
        $this->getMemberSearchIterator = $getMemberSearchIterator;
        $this->update = $update;
        $this->create = $create;
    }

    /**
     * @return void
     * @throws GuzzleException
     * @throws Exception
     */
    public function createOrUpdateMembersInHubSpot(string $memberStatus = 'Active')
    {
        $members = $this->getMemberSearchIterator->getMembers($memberStatus);

        $processed = 0;
        foreach ($members as $member) {
            $processed++;
            if ($hubspotId = $member->getSalesperson3()) {
                error_log("Member {$member->getID()} syncing withing hubspot contact {$hubspotId}");
                $this->update->syncHubSpotContactWithMember($hubspotId, $member);
                error_log("Processed ------------------------------------------> {$processed}");
                continue;
            }
            error_log("Processed ------------------------------------------> {$processed}");
            error_log("Member {$member->getID()} creating new in hubspot");
            $this->create->createHubSpotContactFromMember($member);
        }
    }
}
