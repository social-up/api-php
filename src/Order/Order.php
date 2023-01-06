<?php
declare(strict_types=1);

namespace SocialUp\API\Order;

class Order implements \JsonSerializable
{
    private ?string $link = null;
    private ?float $amount = null;
    private ?int $service = null;

    /**
     * Specify data which should be serialized to JSON
     *
     * @return null[]|string[]
     */
    public function jsonSerialize()
    : array
    {
        return [
            'link' => $this->link,
        ];
    }

    /**
     * Get Name
     *
     * @return string|null
     */
    public function getLink()
    : ?string
    {
        return $this->link;
    }

    /**
     * Set Name
     *
     * @param string|null $link
     * @return Order
     */
    public function setLink(?string $link)
    : Order
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get Amount
     *
     * @return float|null
     */
    public function getAmount()
    : ?float
    {
        return $this->amount;
    }

    /**
     * Set Amount
     *
     * @param float|null $amount
     * @return Order
     */
    public function setAmount(?float $amount)
    : Order
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * Get Service
     *
     * @return int|null
     */
    public function getService()
    : ?int
    {
        return $this->service;
    }

    /**
     * Set Service
     *
     * @param int|null $service
     * @return Order
     */
    public function setService(?int $service)
    : Order
    {
        $this->service = $service;

        return $this;
    }
}
