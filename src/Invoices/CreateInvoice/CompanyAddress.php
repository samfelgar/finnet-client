<?php

namespace Samfelgar\FinnetClient\Invoices\CreateInvoice;

use Spatie\DataTransferObject\DataTransferObject;

class CompanyAddress extends DataTransferObject
{
    public ?string $address;
    public ?int $zipCode;
    public ?int $number;
    public ?string $complement;
    public ?string $neighborhood;
    public ?string $city;
    public ?string $state;
}