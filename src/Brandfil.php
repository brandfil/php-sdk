<?php
declare(strict_types=1);

namespace Brandfil;

use Brandfil\Assembler\DataAssemblerInterface;
use Brandfil\Assembler\PaginationResponseAssembler;
use Brandfil\Authentication\Client;
use Brandfil\Authentication\Credentials;
use Brandfil\DTO\PaginationResponse;
use Brandfil\Exception\BrandfilSDKException;
use Brandfil\Node\ProductFeedNode;
use Unirest\Response;

class Brandfil
{
    /**
     * @const string SDK version
     */
    const VERSION = '1.0';

    /**
     * @const string API version
     */
    const API_VERSION = 'v1';

    /**
     * @var Credentials
     */
    protected $credentials;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var ProductFeedNode
     */
    public $productFeed;

    /**
     * Brandfil constructor.
     *
     * @param array $config
     * @throws BrandfilSDKException
     */
    public function __construct(array $config)
    {
        if (!isset($config['api_url'])) {
            throw new BrandfilSDKException("Missing `api_url` parameter in config.");
        }

        if (!isset($config['api_key'])) {
            throw new BrandfilSDKException("Missing `access_token` parameter in config.");
        }

        $this->credentials = new Credentials($config['api_url'], $config['api_key']);
        $this->client = new Client($this->credentials, self::API_VERSION);
        $this->productFeed = new ProductFeedNode($this);
    }

    /**
     * Send GET request and return the result.
     *
     * @param string $uri
     * @param array $options
     * @return Response
     * @throws BrandfilSDKException
     * @throws Exception\ClientException
     * @throws Exception\ServerException
     * @throws \Unirest\Exception
     */
    public function get(string $uri, array $options = []): Response
    {
        return $this->client->sendRequest('GET', $uri, $options);
    }

    /**
     * Send POST request and return the result.
     *
     * @param string $uri
     * @param array $options
     * @return Response
     * @throws BrandfilSDKException
     * @throws Exception\ClientException
     * @throws Exception\ServerException
     * @throws \Unirest\Exception
     */
    public function post(string $uri, array $options = []): Response
    {
        return $this->client->sendRequest('post', $uri, $options);
    }

    /**
     * Send DELETE request and return the result.
     *
     * @param string $uri
     * @param array $options
     * @return Response
     * @throws BrandfilSDKException
     * @throws Exception\ClientException
     * @throws Exception\ServerException
     * @throws \Unirest\Exception
     */
    public function delete(string $uri, array $options = []): Response
    {
        return $this->client->sendRequest('DELETE', $uri, $options);
    }

    /**
     * Send PATCH request and return the result.
     *
     * @param string $uri
     * @param array $options
     * @return Response
     * @throws BrandfilSDKException
     * @throws Exception\ClientException
     * @throws Exception\ServerException
     * @throws \Unirest\Exception
     */
    public function patch(string $uri, array $options = []): Response
    {
        return $this->client->sendRequest('PATCH', $uri, $options);
    }

    /**
     * Send PUT request and return the result.
     *
     * @param string $uri
     * @param array $options
     * @return Response
     * @throws BrandfilSDKException
     * @throws Exception\ClientException
     * @throws Exception\ServerException
     * @throws \Unirest\Exception
     */
    public function put(string $uri, array $options = []): Response
    {
        return $this->client->sendRequest('PUT', $uri, $options);
    }

    /**
     * @param Response $response
     * @return array
     */
    public function parseResponse(Response $response): array
    {
        return json_decode($response->raw_body, true);
    }

    /**
     * @param Response $response
     * @param string $assemblerFQCN
     * @return PaginationResponse
     * @throws BrandfilSDKException
     */
    public function getPaginationResponse(Response $response, string $assemblerFQCN): PaginationResponse
    {
        $assembler = new $assemblerFQCN();
        $responseAssembler = new PaginationResponseAssembler();

        if($assembler instanceof DataAssemblerInterface === false) {
            throw new BrandfilSDKException('Passed assembler class not implementing DataAssemblerInterface.');
        }

        return $responseAssembler->writeDTO(
            $this->parseResponse($response),
            static function (array $data) use ($assembler) {
                return $assembler->writeDTO($data);
            }
        );
    }

    /**
     * @param Response $response
     * @param string $assemblerFQCN
     * @return mixed
     * @throws BrandfilSDKException
     */
    public function getEdgeResponse(Response $response, string $assemblerFQCN)
    {
        $assembler = new $assemblerFQCN();

        if($assembler instanceof DataAssemblerInterface === false) {
            throw new BrandfilSDKException('Passed assembler class not implementing DataAssemblerInterface.');
        }

        return $assembler->writeDTO($this->parseResponse($response));
    }
}