<?php

namespace Samfelgar\FinnetClient\Payments\RetrievePayment;

use Spatie\DataTransferObject\DataTransferObject;

class Company extends DataTransferObject
{
    public int $bankIdentifier;
    public string $type;
    public string $registeredNumber;
    public string $bankBranch;
    public string $bankAccount;
    public string $bankAccountIdentifier;
    public string $name;
    public CompanyAddress $address;
    public ?array $payments;
}