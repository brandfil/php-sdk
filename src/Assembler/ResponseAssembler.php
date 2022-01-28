<?php
declare(strict_types=1);

namespace Brandfil\Assembler;

use Brandfil\DTO\Response;

/**
 * Class ResponseAssembler
 *
 * @package Brandfil
 */
class ResponseAssembler
{
    /**
     * @param Response $response
     * @return array
     */
    public function readDTO(Response $response): array
    {
        return [
            'status' => $response->getStatus(),
            'data' => $response->getData(),
            'message' => $response->getMessage(),
        ];
    }

    /**
     * @param array $response
     * @param callable|null $callback
     * @return Response
     */
    public function writeDTO(array $response, ?callable $callback = null): Response
    {
        $responseDTO = new Response();
        $responseDTO->setStatus($response['status']);
        $responseDTO->setMessage($response['message']);
        if ($callback instanceof \Closure) {
            $responseDTO->setData($callback($response['data']));
        }

        return $responseDTO;
    }
}