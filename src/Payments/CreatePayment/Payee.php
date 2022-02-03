<?php

namespace Samfelgar\FinnetClient\Payments\CreatePayment;

use Spatie\DataTransferObject\DataTransferObject;

class Payee extends DataTransferObject
{
    public string $name;
    public int $type;
    public int $registeredNumber;
    public ?int $bankIdentifier;
    public ?string $bankBranch;
    public ?string $bankBranchIdentifier;
    public ?string $bankAccount;
    public ?string $bankAccountIdentifier;

    public function toArray(): array
    {
        return [
            'bank_identifier' => $this->bankIdentifier ?? null,
            'bank_branch' => $this->bankBranch ?? null,
            'bank_branch_identifier' => $this-> bankBranchIdentifier ?? null,
            'bank_account' => $this->bankAccount ?? null,
            'bank_account_identifier' => $this->bankAccountIdentifier ?? null,
            'registered_number' => $this->registeredNumber,
            'type' => $this->type,
            'name' => $this->name,
        ];
    }
}