<?php

namespace Samfelgar\FinnetClient\Payments\RetrievePayment;

use Spatie\DataTransferObject\DataTransferObject;

class Event extends DataTransferObject
{
    public string $code;
    public string $description;
}