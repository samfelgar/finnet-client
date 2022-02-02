<?php

namespace Samfelgar\FinnetClient\Payments\RetrievePayment;

use Spatie\DataTransferObject\DataTransferObject;

class Payee extends DataTransferObject
{
    public string $name;
    public ?string $bankIdentifier;
    public ?string $bankBranch;
    public ?string $bankAccount;
    public ?string $bankAccountIdentifier;
    public ?string $registeredNumber;
}