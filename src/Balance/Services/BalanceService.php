<?php
declare(strict_types=1);

namespace SocialUp\API\Balance\Services;

use GuzzleHttp\Exception\ClientException;
use SocialUp\API\Balance\Exceptions\BalanceFailException;
use SocialUp\API\BaseService;

class BalanceService extends BaseService
{
    /**
     * Find by id
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SocialUp\API\Balance\Exceptions\BalanceFailException
     * @throws \JsonException
     */
    public function get()
    : float
    {
        try {
            $response = $this->getClient()->get('api/balance', []);
        } catch (ClientException $exception) {
            $this->handleClientExceptions($exception);

            throw new BalanceFailException('Could not retrieve balance');
        }

        $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        return round($data['balance'], 4);
    }
}
