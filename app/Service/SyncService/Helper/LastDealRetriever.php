<?php

namespace App\Service\SyncService\Helper;

use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\Contacts;
use SevenShores\Hubspot\Resources\Deals;
use stdClass;

class LastDealRetriever
{
    /**
     * @param $hubspotId
     * @return stdClass|null
     */
    public function getLastDealDateFromHubSpot($hubspotId) : ?string
    {
        $client = new Client(['key' => env('HUBSPOT_API_KEY')]);
        $contactRequest = new Contacts($client);
        $contactResponse = $contactRequest->getById($hubspotId);

        if (! $contactResponse->getData() || ! isset($contactResponse->getData()->properties->recent_deal_close_date->value) || ! $contactResponse->getData()->properties->recent_deal_close_date->value) {
            return null;
        }

        return $contactResponse->getData()->properties->recent_deal_close_date->value;
    }
}
