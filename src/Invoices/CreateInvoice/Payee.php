<?php

namespace Samfelgar\FinnetClient\Invoices\CreateInvoice;

use Spatie\DataTransferObject\DataTransferObject;

class Payee extends DataTransferObject
{
    public ?string $email;
    public ?int $ddd;
    public ?int $mobileNumber;

    public function toArray(): array
    {
        $data = [
            'email' => $this->email ?? null,
            'ddd' => $this->ddd ?? null,
            'mobile_number' => $this->mobileNumber ?? null,
        ];

        return array_filter($data, fn($value) => $value !== null);
    }
}