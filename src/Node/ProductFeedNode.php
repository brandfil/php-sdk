<?php
declare(strict_types=1);

namespace Brandfil\Node;

use Brandfil\Assembler\ProductFeed\StatusResponseAssembler;
use Brandfil\Assembler\ProductFeed\UploadResponseAssembler;
use Brandfil\Assembler\ResponseAssembler;
use Brandfil\Brandfil;
use Brandfil\DTO\Response;
use Unirest\Request\Body;

/**
 * Class ProductFeedNode
 * @package Brandfil\Node
 */
final class ProductFeedNode
{
    /**
     * @var Brandfil
     */
    private $brandfil;

    /**
     * ProductFeedNode constructor.
     * @param Brandfil $brandfil
     */
    public function __construct(Brandfil $brandfil)
    {
        $this->brandfil = $brandfil;
    }

    /**
     * @param string $filePath
     * @return Response
     * @throws \Brandfil\Exception\BrandfilSDKException
     * @throws \Brandfil\Exception\ClientException
     * @throws \Brandfil\Exception\ServerException
     * @throws \Unirest\Exception
     */
    public function upload(string $filePath): Response
    {
        $body = Body::multipart([], [
            'file' => $filePath,
        ]);

        $response = $this->brandfil->post('/product_feed/upload', ['body' => $body]);
        $assembler = new ResponseAssembler();
        $uploadResponseAssembler = new UploadResponseAssembler();

        return $assembler->writeDTO(
            $this->brandfil->parseResponse($response),
            static function (array $data) use ($uploadResponseAssembler) {
                return $uploadResponseAssembler->writeDTO($data);
            }
        );
    }

    /**
     * @param string $productFeedId
     * @return Response
     * @throws \Brandfil\Exception\BrandfilSDKException
     * @throws \Brandfil\Exception\ClientException
     * @throws \Brandfil\Exception\ServerException
     * @throws \Unirest\Exception
     */
    public function checkStatus(string $productFeedId): Response
    {
        $response = $this->brandfil->get(
            sprintf('/product_feed/%s/status', $productFeedId),
        );
        $assembler = new ResponseAssembler();
        $statusResponseAssembler = new StatusResponseAssembler();

        return $assembler->writeDTO(
            $this->brandfil->parseResponse($response),
            static function (array $data) use ($statusResponseAssembler) {
                return $statusResponseAssembler->writeDTO($data);
            }
        );
    }
}