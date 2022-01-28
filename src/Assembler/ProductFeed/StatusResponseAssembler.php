<?php
declare(strict_types=1);

namespace Brandfil\Assembler\ProductFeed;

use Brandfil\DTO\ProductFeed\StatusResponse;

/**
 * Class StatusResponseAssembler
 *
 * @package Brandfil
 */
class StatusResponseAssembler
{
    /**
     * @param StatusResponse $response
     * @return array
     */
    public function readDTO(StatusResponse $response): array
    {
        return [
            'status' => $response->getStatus(),
        ];
    }

    /**
     * @param array $response
     * @return StatusResponse
     */
    public function writeDTO(array $response): StatusResponse
    {
        $responseDTO = new StatusResponse();
        $responseDTO->setStatus($response['status']);

        return $responseDTO;
    }
}