<?php
declare(strict_types=1);

namespace SocialUp\API\Ping\Services;

use GuzzleHttp\Exception\ClientException;
use SocialUp\API\BaseService;
use SocialUp\API\Ping\Exceptions\PingFailException;

class PingService extends BaseService
{
    /**
     * Ping API
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SocialUp\API\Ping\Exceptions\PingFailException
     * @throws \JsonException
     */
    public function ping()
    : string
    {
        try {
            $response = $this->getClient()->get('api/ping', []);
        } catch (ClientException $exception) {
            $this->handleClientExceptions($exception);

            throw new PingFailException('Could not ping API');
        }

        $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        return $data['ping'];
    }
}
