<?php

namespace Samfelgar\FinnetClient\Invoices\RetrieveInvoice;

use Spatie\DataTransferObject\DataTransferObject;

class Event extends DataTransferObject
{
    public string $code;
    public string $description;
}