<?php
declare(strict_types=1);

namespace Brandfil\Authentication;

use Brandfil\Exception\BrandfilSDKException;
use Brandfil\Exception\ClientException;
use Brandfil\Exception\RequestException;
use Brandfil\Exception\ServerException;
use Unirest\Request;
use Unirest\Response;

/**
 * Class Client
 *
 * @package Cyberkonsultant
 */
class Client
{
    /**
     * @var Credentials
     */
    protected $credentials;

    /**
     * @var array
     */
    protected $options;

    public function __construct(Credentials $credentials, string $apiVersion)
    {
        $this->credentials = $credentials;
        $this->options = [
            'base_uri' => $this->getBaseUrl((string) $credentials->getUrl(), $apiVersion),
            'headers' => [
                'X-AUTH-TOKEN' => (string)$this->credentials->getApiKey(),
            ]
        ];
    }

    /**
     * Get base url for API.
     *
     * @param string $url
     * @param string $apiVersion
     * @return string
     */
    protected function getBaseUrl(string $url, string $apiVersion): string
    {
        return sprintf('%s/api/%s/', $url, $apiVersion);
    }

    /**
     * Send Request
     *
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return Response
     * @throws BrandfilSDKException
     * @throws ClientException
     * @throws ServerException
     * @throws \Unirest\Exception
     */
    public function sendRequest(string $method, string $uri, array $options = []): Response
    {
        $uri = ltrim($uri, '/');
        $uri = $this->options['base_uri'].$uri;
        $query = $options['query'] ?? [];
        $method = strtolower($method);
        $body = isset($options['json']) ? Request\Body::json($options['json']) : [];
        if (isset($options['body'])) {
            $body = $options['body'];
        }

        switch ($method) {
            case 'get':
                $response = Request::get($uri, $this->options['headers'], $query);
                break;
            case 'post':
                $response = Request::post($uri, $this->options['headers'], $body);
                break;
            case 'put':
                $response = Request::put($uri, $this->options['headers'], $body);
                break;
            case 'patch':
                $response = Request::patch($uri, $this->options['headers'], $body);
                break;
            case 'delete':
                $response = Request::delete($uri, $this->options['headers'], $query);
                break;
            default:
                throw new BrandfilSDKException('Method `'.$method.'` not exist.');
        }

        if ($response->code >= 300) {
            throw RequestException::create($response, $uri, $method);
        }

        return $response;
    }
}