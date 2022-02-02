<?php

namespace Samfelgar\FinnetClient\Payments\RetrievePayment;

use Spatie\DataTransferObject\DataTransferObject;

class CompanyAddress extends DataTransferObject
{
    public string $address;
    public string $number;
    public string $complement;
    public string $city;
    public string $zipCode;
    public string $state;
}