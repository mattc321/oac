<?php

namespace App\Console\Commands\MotionSoft;

use App\Api\MotionSoft\Members\GetMemberSearchIterator;
use App\Api\MotionSoft\Model\MemberModel;
use App\Api\MotionSoft\MotionSoftClient;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;

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
     * Create a new command instance.
     *
     * @param GetMemberSearchIterator $getMemberSearchIterator
     */
    public function __construct(GetMemberSearchIterator $getMemberSearchIterator)
    {
        parent::__construct();
        $this->getMemberSearchIterator = $getMemberSearchIterator;
    }

    /**
     * @return void
     * @throws Exception
     */
    public function handle()
    {
        foreach ($this->getMemberSearchIterator->getMembers() as $member) {
            $this->info($member->getID());
            //create it in hubspot
        }
    }
}
