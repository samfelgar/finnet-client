<?php

namespace Samfelgar\FinnetClient\Payments\CreatePayment;

use Spatie\DataTransferObject\DataTransferObject;

class Taxpayer extends DataTransferObject
{
    public int $type;
    public int $identifier;
    public string $name;

    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'identifier' => $this->identifier,
            'name' => $this->name,
        ];
    }
}