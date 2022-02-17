<?php

namespace Samfelgar\FinnetClient\Invoices\RetrieveInvoice;

use Spatie\DataTransferObject\DataTransferObject;

class Status extends DataTransferObject
{
    public string $code;
    public string $description;
}