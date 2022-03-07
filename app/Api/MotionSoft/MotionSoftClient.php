<?php

namespace App\Api\MotionSoft;

use App\Api\MotionSoft\Model\MemberModel;
use DateTime;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Cookie\SetCookie as CookieParser;

/**
 * https://olympicathleticclub.mosoclub.net/swagger/ui/index
 */
class MotionSoftClient
{

    /**
     * @var mixed
     */
    private $username;
    /**
     * @var mixed
     */
    private $password;
    /**
     * @var mixed
     */
    private $machineName;
    /**
     * @var mixed
     */
    private $baseUri;
    /**
     * @var mixed
     */
    private $verifySsl;
    /**
     * @var null
     */
    private $client;
    /**
     * @var string
     */
    private $authCookie;

    public function __construct()
    {
        $this->username = env('MOTION_SOFT_API_USER_ID');
        $this->password  = env('MOTION_SOFT_API_PASSWORD');
        $this->machineName = env('MOTION_SOFT_API_MACHINE_NAME');
        $this->baseUri = env('MOTION_SOFT_BASE_URI');
        $this->verifySsl = env('MOTION_SOFT_API_VERIFY_SSL');
        $this->authCookie = null;
        $this->client = null;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        if ($this->client) {
            return $this->client;
        }

        $this->client = new Client([
            'base_uri' => $this->baseUri,
            'verify'  => $this->verifySsl,
        ]);

        return $this->client;
    }

    /**
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function authenticate(): ResponseInterface
    {
        $endPoint = "Account/Authenticate?userId={$this->username}&password={$this->password}&machinename={$this->machineName}";
        $response = $this->getClient()->request('POST', $endPoint);

        $cookies = $response->getHeader('Set-Cookie');
        $cookieParser = new CookieParser;
        $finalCookie = [];
        foreach ($cookies as $cookie) {
            $cookie = $cookieParser->fromString($cookie);
            $finalCookie[] = $cookie->getName() . '=' . $cookie->getValue();
        }

        $this->authCookie = implode('; ', $finalCookie);
        return $response;
    }

    /**
     * @param string $memberStatus
     * @param int|null $pageNumber
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getMembers(string $memberStatus = 'Active', ?int $pageNumber = null): ResponseInterface
    {
        $this->authenticate();

        $endPoint = 'MemberSearch/FindMembers';
        $options = [
            'query' => [
                'memberStatus' => $memberStatus
            ],
            'headers' => [
                'Cookie' => $this->authCookie
            ]
        ];

        if ($pageNumber) {
            $options['query']['pageNumber'] = $pageNumber;
        }

        return $this->getClient()->request('GET', $endPoint, $options);
    }

    /**
     * @param int|string $memberId
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getMemberById($memberId)
    {
        $this->authenticate();

        $options = [
            'headers' => [
                'Cookie' => $this->authCookie
            ]
        ];

        $endPoint = "Member/GetMemberByMemberID?memberId={$memberId}";

        return $this->getClient()->request('GET', $endPoint, $options);
    }

    /**
     * @param $memberId
     * @param DateTime|null $dateStart
     * @param DateTime|null $dateEnd
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getMemberLedger($memberId, ?DateTime $dateStart = null, ?DateTime $dateEnd = null): ResponseInterface
    {
        //MAX ONE YEAR AT A TIME. DEFAULT IS YTD

        $this->authenticate();

        $endPoint = 'Member/GetMemberLedgerByMemberID';
        $options = [
            'query' => [
                'memberId' => $memberId
            ],
            'headers' => [
                'Cookie' => $this->authCookie
            ]
        ];

        if ($dateStart) {
            $options['query']['startSaleDate'] = $dateStart->format('Y-m-d');
        }

        if ($dateEnd) {
            $options['query']['endSaleDate'] = $dateEnd->format('Y-m-d');
        }

        return $this->getClient()->request('GET', $endPoint, $options);
    }

    /**
     * Update a whole member or pass an array to update just specific fields
     * @param MemberModel|null $memberModel
     * @param array $memberFieldsArray
     * @return ResponseInterface
     * @throws GuzzleException
     * @throws Exception
     */
    public function updateMember(?MemberModel $memberModel = null, array $memberFieldsArray = []): ResponseInterface
    {
        if (! $memberModel && ! $memberFieldsArray) {
            throw new Exception('No member information to update.');
        }

        $this->authenticate();

        $body = $memberModel ? $memberModel->toArray() : $memberFieldsArray;

        $endPoint = 'Member/UpdateMemberDemographic';
        $options = [
            'json' => $body,
            'headers' => [
                'Cookie' => $this->authCookie
            ]
        ];
        return $this->getClient()->request('PUT', $endPoint, $options);
    }
}
