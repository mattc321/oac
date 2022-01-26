<?php

namespace App\Api\MotionSoft;

use GuzzleHttp\Client;
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
     * @throws \GuzzleHttp\Exception\GuzzleException
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
}
