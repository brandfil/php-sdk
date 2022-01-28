<?php
declare(strict_types=1);

namespace Brandfil\Model;

/**
 * Interface ListResponse
 *
 * @package Brandfil
 */
interface ListResponse
{
    /**
     * @return int
     */
    public function getCurrentPage(): int;

    /**
     * @return int
     */
    public function getLastPage(): int;

    /**
     * @return int
     */
    public function getRows(): int;

    /**
     * @return array
     */
    public function getData(): array;

    /**
     * @return int
     */
    public function getRowsPerPage(): int;

    /**
     * @param array $data
     */
    public function setData(array $data): void;
}