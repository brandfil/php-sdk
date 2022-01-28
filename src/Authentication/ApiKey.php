<?php
declare(strict_types=1);

namespace Brandfil\Authentication;

/**
 * Class ApiKey
 *
 * @package Brandfil
 */
class ApiKey
{
    /**
     * ApiKey value.
     *
     * @var string
     */
    protected $value = "";

    /**
     * ApiKey constructor.
     *
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        $this->value = $apiKey;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}