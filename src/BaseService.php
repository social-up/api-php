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
        switch ($e->getResponse()->getStatusCode()) {
            case 401:
                // Handle 401 Unauthorized error
                throw new \RuntimeException($e->getResponse()->getHeader('WWW-Authenticate')[0]);
                break;
            case 404:
                // Handle 404 Not Found error
                break;
            case 405:
                // Handle 405 Now Allowed error
                throw new \RuntimeException($e->getResponse()->getReasonPhrase());
                break;
            case 500:
                // Handle 500 Internal Server Error
                break;
            default:
                // Handle other 4xx errors
                break;
        }
    }
}
