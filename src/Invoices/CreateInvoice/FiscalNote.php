<?php

namespace Samfelgar\FinnetClient\Invoices\CreateInvoice;

use Spatie\DataTransferObject\DataTransferObject;

class FiscalNote extends DataTransferObject
{
    public ?string $fiscalNoteNumber1;
    public ?float $fiscalNoteValue1;
    public ?string $fiscalNoteDate1;
    public ?string $danfeNf1AccessKey;
    public ?string $fiscalNoteNumber2;
    public ?float $fiscalNoteValue2;
    public ?string $fiscalNoteDate2;
    public ?string $danfeNf2AccessKey;
    public ?string $fiscalNoteNumber3;
    public ?float $fiscalNoteValue3;
    public ?string $fiscalNoteDate3;
    public ?string $fiscalNoteNumber4;
    public ?float $fiscalNoteValue4;
    public ?string $fiscalNoteDate4;
    public ?string $fiscalNoteNumber5;
    public ?float $fiscalNoteValue5;
    public ?string $fiscalNoteDate5;

    public function toArray(): array
    {
        $data = [
            'fiscal_note_number_1' => $this->fiscalNoteNumber1 ?? null,
            'fiscal_note_value_1' => $this->fiscalNoteValue1 ?? null,
            'fiscal_note_date_1' => $this->fiscalNoteDate1 ?? null,
            'DANFE_NF_1_access_key' => $this->danfeNf1AccessKey ?? null,
            'fiscal_note_number_2' => $this->fiscalNoteNumber2 ?? null,
            'fiscal_note_value_2' => $this->fiscalNoteValue2 ?? null,
            'fiscal_note_date_2' => $this->fiscalNoteDate2 ?? null,
            'danfe_nf2_access_key' => $this->danfeNf2AccessKey ?? null,
            'fiscal_note_number_3' => $this->fiscalNoteNumber3 ?? null,
            'fiscal_note_value_3' => $this->fiscalNoteValue3 ?? null,
            'fiscal_note_date_3' => $this->fiscalNoteDate3 ?? null,
            'fiscal_note_number_4' => $this->fiscalNoteNumber4 ?? null,
            'fiscal_note_value_4' => $this->fiscalNoteValue4 ?? null,
            'fiscal_note_date_4' => $this->fiscalNoteDate4 ?? null,
            'fiscal_note_number_5' => $this->fiscalNoteNumber5 ?? null,
            'fiscal_note_value_5' => $this->fiscalNoteValue5 ?? null,
            'fiscal_note_date_5' => $this->fiscalNoteDate5 ?? null,
        ];

        return array_filter($data, fn($value) => $value !== null);
    }
}