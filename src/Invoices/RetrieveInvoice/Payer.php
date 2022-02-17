<?php

namespace Samfelgar\FinnetClient\Invoices\RetrieveInvoice;

use Spatie\DataTransferObject\DataTransferObject;

class Payer extends DataTransferObject
{
    public string $type;
    public string $registeredNumber;
    public string $name;
}