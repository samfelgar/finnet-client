<?php

namespace Samfelgar\FinnetClient\Payments\CreatePayment;

use DateTime;
use ReflectionClass;
use ReflectionProperty;
use Spatie\DataTransferObject\DataTransferObject;

class Payment extends DataTransferObject
{
    public string $type;
    public string $identifier;
    public DateTime $date;
    public float $amount;
    public string $bankAuthentication;
    public ?string $barCode;
    public ?DateTime $dueDate;
    public ?float $originalAmount;
    public ?Tax $tax;
    public ?float $penaltyAmount;
    public ?float $interestAmount;
    public ?float $grossRevenue;
    public ?float $grossRevenuePercentage;
    public ?float $otherEntitiesAmount;
    public ?float $currencyRestatementAmount;
    public ?int $stateRegistration;

    public function toArray(): array
    {
        $this->prepareProperties();

        $data = [
            'type' => $this->type,
            'identifier' => $this->identifier,
            'date' => $this->date->format('Y-m-d'),
            'amount' => $this->amount,
            'bank_authentication' => $this->bankAuthentication,
            'bar_code' => $this->barCode,
            'due_date' => isset($this->dueDate) ? $this->dueDate->format('Y-m-d') : null,
            'original_amount' => $this->originalAmount,
            'penalty_amount' => $this->penaltyAmount,
            'interest_amount' => $this->interestAmount,
            'gross_revenue' => $this->grossRevenue,
            'gross_revenue_percentage' => $this->grossRevenuePercentage,
            'other_entities_amount' => $this->otherEntitiesAmount,
            'currency_restatement_amount' => $this->currencyRestatementAmount,
            'state_registration' => $this->stateRegistration,
        ];

        if (isset($this->tax)) {
            $data['tax_code'] = $this->tax->code ?? null;
            $data['tax_calculation_period'] = isset($this->tax->calculationPeriod) ? $this->tax->calculationPeriod->format('Y-m-d') : null;
            $data['tax_identifier'] = $this->tax->identifier ?? null;
            $data['tax_installment_number'] = $this->tax->installmentNumber ?? null;
            $data['tax_active_debt_number'] = $this->tax->activeDebtNumber ?? null;
            $data['tax_fgts_identifier'] = $this->tax->fgtsIdentifier ?? null;
            $data['tax_fgts_connectivity_number'] = $this->tax->fgtsConnectivityNumber ?? null;
            $data['tax_fgts_connectivity_number_identifier'] = $this->tax->fgtsConnectivityNumberIdentifier ?? null;
        }

        return array_filter($data, fn($value) => $value !== null);
    }

    private function prepareProperties(): void
    {
        $properties = (new ReflectionClass($this))->getProperties(ReflectionProperty::IS_PUBLIC);

        foreach ($properties as $property) {
            if ($property->isStatic()) {
                continue;
            }

            if ($property->getType()->allowsNull() && !$property->isInitialized($this)) {
                $property->setValue($this, null);
            }
        }
    }
}