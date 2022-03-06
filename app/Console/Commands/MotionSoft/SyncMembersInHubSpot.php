<?php

namespace App\Console\Commands\MotionSoft;

use App\Service\MotionSoftSyncService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use Psr\Log\LoggerInterface;
use Throwable;

class SyncMembersInHubSpot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'motionsoft:syncMembersInHubSpot
                            {status : Active, InActive, Terminated, Frozen, Expired}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync members from motionsoft to hubspot';
    /**
     * @var MotionSoftSyncService
     */
    private $motionSoftSyncService;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param MotionSoftSyncService $motionSoftSyncService
     */
    public function __construct(
        MotionSoftSyncService $motionSoftSyncService,
        LoggerInterface $logger
    ) {
        parent::__construct();
        $this->motionSoftSyncService = $motionSoftSyncService;
        $this->logger = $logger;
    }

    /**
     * @return void
     * @throws GuzzleException
     * @throws Throwable
     */
    public function handle()
    {

        $status = $this->argument('status');

        $memberStatuses = [
            'Active',
            'InActive',
            'Terminated',
            'Frozen',
            'Expired'
        ];

        if (! $status || ! in_array($status, $memberStatuses)) {
            $this->error('Must supply a member status to sync.');
            return;
        }

        $startTime = time();
        $this->logger->info("Begin SyncMembersInHubSpot command at {$startTime}");

        try {
            $statusTime = time();
            $this->logger->info("Syncing {$status} members at {$statusTime}");
            $this->info("Syncing {$status} members ----------------->");
            $this->motionSoftSyncService->createOrUpdateMembersInHubSpot($status);
        } catch (Throwable $t) {
            //send an email
            $errorTime = time();
            $this->logger->error("An error occurred during SyncMembersInHubSpot job {$errorTime}", ['exception' => $t]);
        }

        $endTime = time();
        $this->logger->info("End SyncMembersInHubSpot command at {$endTime}");
    }
}
