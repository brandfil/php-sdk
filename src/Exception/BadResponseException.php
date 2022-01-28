<?php
declare(strict_types=1);

namespace Brandfil\Exception;

use Unirest\Response;

/**
 * Class BadResponseException
 * @package Brandfil
 */
class BadResponseException extends RequestException
{
    public function __construct(
        string $message,
        Response $response,
        string $uri = null,
        string $method = null,
        \Throwable $previous = null
    ) {
        parent::__construct($message, $response, $uri, $method, $previous);
    }

    /**
     * This function narrows the return type from the parent class and does not allow it to be nullable.
     */
    public function getResponse(): Response
    {
        /** @var Response */
        return parent::getResponse();
    }
}