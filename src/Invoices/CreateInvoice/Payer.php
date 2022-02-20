<?php

namespace Samfelgar\FinnetClient\Invoices\CreateInvoice;

use Spatie\DataTransferObject\DataTransferObject;

class Payer extends DataTransferObject
{
    public int $registrationType;
    public ?string $registrationNumber;
    public string $name;
    public string $address;
    public string $neighborhood;
    public int $zipCode;
    public int $zipCodeSuffix;
    public string $city;
    public string $state;

    public function toArray(): array
    {
        $data = [
            'registration_type' => $this->registrationType,
            'registration_number' => $this->registrationNumber ?? null,
            'name' => $this->name,
            'address' => $this->address,
            'neighborhood' => $this->neighborhood,
            'zip_code' => $this->zipCode,
            'zip_code_suffix' => $this->zipCodeSuffix,
            'city' => $this->city,
            'state' => $this->state,
        ];

        return array_filter($data, fn($value) => $value !== null);
    }
}