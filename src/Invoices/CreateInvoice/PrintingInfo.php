<?php

namespace Samfelgar\FinnetClient\Invoices\CreateInvoice;

use Spatie\DataTransferObject\DataTransferObject;

class PrintingInfo extends DataTransferObject
{
    public ?int $printingIdentification;
    public ?int $lineNumber;
    public ?string $message;
    public ?int $characterType;
    public ?string $message5;
    public ?string $message6;
    public ?string $message7;
    public ?string $message8;
    public ?string $message9;

    public function toArray(): array
    {
        $data = [
            'printing_identification' => $this->printingIdentification ?? null,
            'line_number' => $this->lineNumber ?? null,
            'message' => $this->message ?? null,
            'character_type' => $this->characterType ?? null,
            'message_5' => $this->message5 ?? null,
            'message_6' => $this->message6 ?? null,
            'message_7' => $this->message7 ?? null,
            'message_8' => $this->message8 ?? null,
            'message_9' => $this->message9 ?? null,
        ];

        return array_filter($data, fn($value) => $value !== null);
    }
}