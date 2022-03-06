<?php

namespace App\Service\SyncService;

use App\Api\MotionSoft\Model\MemberModel;
use App\Service\SyncService\Helper\DateTimeConverter;
use Exception;

class SyncProperties
{
    const FIELDS_TO_SYNC = [
        'Acctnote' => 'acctnote',
        'Address1' => 'address',
        'Birthday' => 'birthday',
        'City' => 'city',
        'Company' => 'company',
        'DoNotSendTextMessages' => 'donotsendtextmessages',
        'DoNotEmail' => 'donotemail',
        'EnteredDate' => 'entereddate',
        'Email' => 'email',
        'FirstName' => 'firstname',
        'Gender' => 'motionsoft_gender',
        'ID' => 'motionsoft_member_id',
        'LastName' => 'lastname',
        'Membership_Type' => 'membership_type',
        'MemberStatus' => 'motionsoft_membership_status',
        'Memo' => 'memo',
        'Phone1' => 'phone',
        'State' => 'state',
        'Zip' => 'zip'
    ];
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
     * @param MemberModel $member
     * @return array
     * @throws Exception
     */
    public function getSyncProperties(MemberModel $member): array
    {
        $fieldsToSync = self::FIELDS_TO_SYNC;
        $properties = [];
        foreach ($fieldsToSync as $motionSoftProperty => $hubspotProperty) {
            if ($member->$motionSoftProperty === null || trim($member->$motionSoftProperty) === '') {
                continue;
            }
            $value = $member->$motionSoftProperty;
            if ($hubspotProperty === 'address') {
                $value = "{$member->getAddress1()} {$member->getAddress2()}";
            }
            if ($hubspotProperty === 'birthday' || $hubspotProperty === 'entereddate') {
                $value = $this->dateTimeConverter->convertDateToTimeStamp($member->$motionSoftProperty);
            }
            $properties[] = [
                'property' => $hubspotProperty,
                'value' => $value
            ];
        }
        return $properties;
    }
}
