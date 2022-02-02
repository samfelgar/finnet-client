<?php

namespace Samfelgar\FinnetClient\Payments\RetrievePayment;

use Spatie\DataTransferObject\DataTransferObject;

class Tax extends DataTransferObject
{
    public ?string $code;
    public ?string $calculationPeriod;
    public ?string $identifier;
}