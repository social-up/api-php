<?php
declare(strict_types=1);

namespace SocialUp\API;

use GuzzleHttp\Client as HttpClient;
use SocialUp\API\Balance\Services\BalanceService;

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

    public function balance()
    : BalanceService
    {
        return new BalanceService($this->getClient());
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
