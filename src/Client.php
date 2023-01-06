<?php
declare(strict_types=1);

namespace SocialUp\API;

use GuzzleHttp\Client as HttpClient;
use SocialUp\API\Ping\Services\PingService;

class Client
{
    private HttpClient $client;

    public function __construct(string $token)
    {
        $client = new HttpClient([
            'base_uri' => 'https://www.agenciasocialup.com/',
            'timeout'  => 10.0,
            'headers'  => [
                'Authorization' => sprintf('Bearer %s', $token),
                'Accept'        => 'application/json',
            ],
        ]);

        $this->setClient($client);
    }

    /**
     * Ping API
     *
     * @throws \SocialUp\API\Ping\Exceptions\PingFailException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function ping()
    : string
    {
        return (new PingService($this->getClient()))->ping();
    }

    /**
     * Get client
     *
     * @return \GuzzleHttp\Client
     */
    public function getClient()
    : HttpClient
    {
        if (!isset($this->client)) {
            throw new \RuntimeException('HTTP client not defined');
        }

        return $this->client;
    }

    /**
     * Set client
     *
     * @param \GuzzleHttp\Client $client
     * @return \SocialUp\API\Client
     */
    public function setClient(HttpClient $client)
    : Client
    {
        $this->client = $client;

        return $this;
    }
}
