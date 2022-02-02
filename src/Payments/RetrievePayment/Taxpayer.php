<?php

namespace Samfelgar\FinnetClient\Payments\RetrievePayment;

use Spatie\DataTransferObject\DataTransferObject;

class Taxpayer extends DataTransferObject
{
    public string $identifier;
    public string $name;
    public ?string $type;
}