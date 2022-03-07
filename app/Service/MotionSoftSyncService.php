<?php

namespace App\Service;

use App\Api\MotionSoft\Members\GetMemberSearchIterator;
use App\Api\MotionSoft\Model\MemberModel;
use App\Service\SyncService\Create;
use App\Service\SyncService\Update;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Log\LoggerInterface;

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
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param GetMemberSearchIterator $getMemberSearchIterator
     * @param Update $update
     * @param Create $create
     * @param LoggerInterface $logger
     */
    public function __construct(GetMemberSearchIterator $getMemberSearchIterator, Update $update, Create $create, LoggerInterface $logger)
    {
        $this->getMemberSearchIterator = $getMemberSearchIterator;
        $this->update = $update;
        $this->create = $create;
        $this->logger = $logger;
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
            try {
                $this->process($member, $processed);
            } catch (\Throwable $t) {
                $errorTime = time();
                $errorMessage = "Sync Error - Member {$member->getID()} : An error occurred during SyncMembersInHubSpot job {$errorTime}";
                error_log($errorMessage);
                $this->logger->error($errorMessage, ['exception' => $t]);
                //send an email
            }
        }
    }

    /**
     * @param MemberModel $member
     * @param $processed
     * @return void
     * @throws GuzzleException
     */
    private function process(MemberModel $member, $processed)
    {
        if ($hubspotId = $member->getSalesperson3()) {
            error_log("Member {$member->getID()} syncing withing hubspot contact {$hubspotId}");
            $this->update->syncHubSpotContactWithMember($hubspotId, $member);
            error_log("Processed ------------------------------------------> {$processed}");
            return;
        }
        error_log("Processed ------------------------------------------> {$processed}");
        error_log("Member {$member->getID()} creating new in hubspot");
        $this->create->createHubSpotContactFromMember($member);
    }
}
