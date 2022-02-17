<?php

namespace Samfelgar\FinnetClient\Invoices\RetrieveInvoice;

use Spatie\DataTransferObject\DataTransferObject;

class Company extends DataTransferObject
{
    public int $bankIdentifier;
    public string $type;
    public string $registeredNumber;
    public string $bankBranch;
    public string $bankBranchIdentifier;
    public string $bankAgreement;
    public string $name;
    public ?array $invoices;
}