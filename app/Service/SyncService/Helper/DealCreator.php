<?php

namespace App\Service\SyncService\Helper;

use Exception;
use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Http\Response;
use SevenShores\Hubspot\Resources\Deals;

class DealCreator
{

    const TYPE_PAYMENT = 'Payment';
    const TYPE_INVOICE = 'Invoice';

    /**
     * @var DateTimeConverter
     */
    private $dateTimeConverter;

    /**
     * @param DateTimeConverter $dateTimeConverter
     */
    public function __construct(DateTimeConverter $dateTimeConverter)
    {
        $this->dateTimeConverter = $dateTimeConverter;
    }

    /**
     * @param $contactId
     * @param string $amount
     * @param string $date
     * @param string|int $ledgerId
     * @param string $type
     * @return Response
     * @throws Exception
     */
    public function createDealForHubSpotContact(
        $contactId,
        string $amount,
        string $date,
        $ledgerId,
        string $type = 'Payment'
    ): Response {
        $client = new Client(['key' => env('HUBSPOT_API_KEY')]);
        $request = new Deals($client);
        $ass = [
            'associatedVids' => [
                $contactId
            ]
        ];
        $properties = [
            [
                'value' => $type,
                'name' => 'dealname'
            ],
            [
                'value' => 'closedwon',
                'name' => 'dealstage'
            ],
            [
                'value' => 'default',
                'name' => 'pipeline'
            ],
            [
                'value' => $this->dateTimeConverter->convertDateToTimeStamp($date),
                'name' => 'closedate'
            ],
            [
                'value' => $amount,
                'name' => 'amount'
            ],
            [
                'value' => $this->dateTimeConverter->convertDateToTimeStamp($date),
                'name' => 'createdate'
            ],
            [
                'value' => $ledgerId,
                'name' => 'motionsoft_ledger_id'
            ]
        ];
        return $request->create($properties, $ass);
    }
}
