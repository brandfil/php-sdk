<?php
declare(strict_types=1);

namespace Brandfil\Model;

interface Response
{
    public function getStatus(): string;
    public function getMessage(): ?string;
    public function getData();
}