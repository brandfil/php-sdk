<?php
declare(strict_types=1);

namespace Brandfil\DTO\ProductFeed;

/**
 * Class UploadResponse
 * @package Brandfil
 */
class UploadResponse
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }
}