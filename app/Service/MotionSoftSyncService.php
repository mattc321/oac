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

        foreach ($members as $member) {
            if ($hubspotId = $member->getSalesperson3()) {
                $this->update->syncHubSpotContactWithMember($hubspotId, $member);
                continue;
            }

            $this->create->createHubSpotContactFromMember($member);
        }
    }
}
