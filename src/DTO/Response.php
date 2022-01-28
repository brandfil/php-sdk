<?php
declare(strict_types=1);

namespace Brandfil\DTO;

use Brandfil\Model\Response as ResponseInterface;

/**
 * Class SuccessResponse
 *
 * @package Cyberkonsultant
 */
class Response implements ResponseInterface
{
    /**
     * @var string
     */
    private $status;

    /**
     * @var mixed
     */
    private $data;

    /**
     * @var string|null
     */
    private $message;

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param string|null $message
     */
    public function setMessage(?string $message): void
    {
        $this->message = $message;
    }
}