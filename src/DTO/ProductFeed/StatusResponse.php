<?php
declare(strict_types=1);

namespace Brandfil\DTO\ProductFeed;

/**
 * Class StatusResponse
 * @package Brandfil
 */
class StatusResponse
{
    /**
     * @var string
     */
    protected $status;

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}