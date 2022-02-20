<?php

namespace Samfelgar\FinnetClient\Invoices\CreateInvoice;

use Spatie\DataTransferObject\DataTransferObject;

class Company extends DataTransferObject
{
    public int $bankIdentifier;
    public int $bankBranch;
    public string $bankBranchIdentifier;
    public int $bankAccount;
    public string $bankAccountIdentifier;
    public string $bankAgreement;
    public string $registeredNumber;
    public ?int $type;
    public ?string $name;
    public ?CompanyAddress $address;

    public function toArray(): array
    {
        $data = [
            'bank_identifier' => $this->bankIdentifier,
            'bank_branch' => $this->bankBranch,
            'bank_branch_identifier' => $this->bankBranchIdentifier,
            'bank_account' => $this->bankAccount,
            'bank_account_identifier' => $this->bankAccountIdentifier,
            'bank_agreement' => $this->bankAgreement,
            'registered_number' => $this->registeredNumber,
            'type' => $this->type ?? null,
            'name' => $this->name ?? null,
        ];

        if (isset($this->address)) {
            $data['address'] = $this->address->address ?? null;
            $data['address_zip_code'] = $this->address->zipCode ?? null;
            $data['address_number'] = $this->address->number ?? null;
            $data['address_complement'] = $this->address->complement ?? null;
            $data['address_neighborhood'] = $this->address->neighborhood ?? null;
            $data['address_city'] = $this->address->city ?? null;
            $data['address_state'] = $this->address->state ?? null;
        }

        return array_filter($data, fn($value) => $value !== null);
    }
}