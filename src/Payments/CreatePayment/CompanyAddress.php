<?php

namespace Samfelgar\FinnetClient\Payments\CreatePayment;

use Spatie\DataTransferObject\DataTransferObject;

class CompanyAddress extends DataTransferObject
{
    public string $address;
    public int $number;
    public string $complement;
    public string $neighborhood;
    public string $city;
    public string $state;
    public int $zipCode;
}