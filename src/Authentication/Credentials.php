<?php
declare(strict_types=1);

namespace Brandfil\Authentication;

use Brandfil\Exception\BrandfilSDKException;

/**
 * Class Credentials
 *
 * @package Brandfil
 */
class Credentials
{
    /**
     * @var ApiBaseUrl
     */
    protected $url;

    /**
     * @var ApiKey
     */
    protected $apiKey;

    /**
     * Credentials constructor.
     * @param string $url
     * @param string $apiKey
     * @throws BrandfilSDKException
     */
    public function __construct(string $url, string $apiKey)
    {
        $this->url = new ApiBaseUrl($url);
        $this->apiKey = new ApiKey($apiKey);
    }

    /**
     * @return ApiBaseUrl
     */
    public function getUrl(): ApiBaseUrl
    {
        return $this->url;
    }

    /**
     * @return ApiKey
     */
    public function getApiKey(): ApiKey
    {
        return $this->apiKey;
    }
}