<?php
declare(strict_types=1);

namespace Brandfil\Assembler\ProductFeed;

use Brandfil\DTO\ProductFeed\UploadResponse;

/**
 * Class UploadResponseAssembler
 *
 * @package Brandfil
 */
class UploadResponseAssembler
{
    /**
     * @param UploadResponse $response
     * @return array
     */
    public function readDTO(UploadResponse $response): array
    {
        return [
            'id' => $response->getId(),
        ];
    }

    /**
     * @param array $response
     * @return UploadResponse
     */
    public function writeDTO(array $response): UploadResponse
    {
        $responseDTO = new UploadResponse();
        $responseDTO->setId($response['id']);

        return $responseDTO;
    }
}