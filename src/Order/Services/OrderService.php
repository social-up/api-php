<?php
declare(strict_types=1);

namespace SocialUp\API\Order\Services;

use GuzzleHttp\Exception\ClientException;
use SocialUp\API\BaseService;
use SocialUp\API\Order\Exceptions\CreateOrderFailException;
use SocialUp\API\Order\Exceptions\OrderNotFoundException;
use SocialUp\API\Order\Order;

class OrderService extends BaseService
{
    /**
     * Find by id
     *
     * @param string $id
     * @return object
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     * @throws \SocialUp\API\Order\Exceptions\OrderNotFoundException
     */
    public function findById(string $id)
    : object
    {
        $uri = sprintf('/api/order/%s', $id);

        try {
            $response = $this->getClient()->get($uri);
        } catch (ClientException $exception) {
            $this->handleClientExceptions($exception);

            throw new OrderNotFoundException('Order with provided id could not be founded');
        }

        return json_decode($response->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * Find all
     *
     * @param array $options
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     * @throws \SocialUp\API\Order\Exceptions\OrderNotFoundException
     */
    public function findAll(array $options = [])
    : array
    {
        $uri = '/api/order';

        try {
            $response = $this->getClient()->get($uri, $options);
        } catch (ClientException $exception) {
            $this->handleClientExceptions($exception);

            throw new OrderNotFoundException('Orders with provided params could not be founded');
        }

        return json_decode($response->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * Create order
     *
     * @param \SocialUp\API\Order\Order $order
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     * @throws \SocialUp\API\Order\Exceptions\CreateOrderFailException
     */
    public function create(Order $order)
    : array
    {
        $uri = '/api/order';

        try {
            $response = $this->getClient()->post($uri, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'body'    => json_encode($order, JSON_THROW_ON_ERROR),
            ]);
        } catch (ClientException $exception) {
            $this->handleClientExceptions($exception);

            throw new CreateOrderFailException('Order with provided params could not be created');
        }

        return json_decode($response->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR);
    }
}
