<?php
declare(strict_types=1);

namespace SocialUp\API;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

abstract class BaseService
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getClient()
    : Client
    {
        return $this->client;
    }

    /**
     * Handle client exceptions
     *
     * @param \GuzzleHttp\Exception\ClientException $e
     * @return void
     */
    public function handleClientExceptions(ClientException $e)
    : void
    {
        $statusCode = $e->getResponse()->getStatusCode();

        if ($statusCode === 401) {
            // Handle 401 Unauthorized error
            throw new \RuntimeException($e->getResponse()->getHeader('WWW-Authenticate')[0]);
        }

        // Handle other 4xx errors
        throw new \RuntimeException($e->getResponse()->getReasonPhrase());
    }
}
