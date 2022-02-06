<?php

namespace App\Api\MotionSoft\Members;

use App\Api\MotionSoft\Model\MemberModel;
use App\Api\MotionSoft\MotionSoftClient;
use Generator;

class GetMemberSearchIterator
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

    public function getMembers(string $memberStatus = 'Active') : Generator
    {
        //TODO UPDATE THIS PAGE COUNT
        $maxPageCount = 2;
        $pageCount = 0;

        while ($pageCount < $maxPageCount) {
            $pageCount++;

            error_log("Member search pulling page {$pageCount}");

            $request  = $this->client->getMembers($memberStatus);
            $body = json_decode($request->getBody(), true);

            if (! isset($body['Data']['Results'])) {
                throw new \Exception('No results found');
            }

            if (! $body['Data']['Results']) {
                error_log("Member search ended on page {$pageCount}");
                return;
            }

            $memberSearchResults = $body['Data']['Results'];

            foreach ($memberSearchResults as $member) {
                yield new MemberModel($member);
            }
        }
        error_log("Member search ended on page {$pageCount}");

    }
}
