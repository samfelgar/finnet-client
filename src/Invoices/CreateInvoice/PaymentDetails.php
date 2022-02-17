<?php

namespace Samfelgar\FinnetClient\Invoices\CreateInvoice;

use Spatie\DataTransferObject\DataTransferObject;

class PaymentDetails extends DataTransferObject
{
    public ?int $paymentTypeIdentification;
    public ?int $amountOfPossiblePayments;
    public ?int $typeOfInformedValueMax;
    public ?float $maxValue;
    public ?float $maxPercent;
    public ?int $typeOfInformedValueMin;
    public ?float $minValue;
    public ?float $minPercent;

    public function toArray(): array
    {
        $data = [
            'payment_type_identification' => $this->paymentTypeIdentification ?? null,
            'amount_of_possible_payments' => $this->amountOfPossiblePayments ?? null,
            'type_of_informed_value_max' => $this->typeOfInformedValueMax ?? null,
            'max_value' => $this->maxValue ?? null,
            'max_percent' => $this->maxPercent ?? null,
            'type_of_informed_value_min' => $this->typeOfInformedValueMin ?? null,
            'min_value' => $this->minValue ?? null,
            'min_percent' => $this->minPercent ?? null,
        ];

        return array_filter($data, fn($value) => $value !== null);
    }
}