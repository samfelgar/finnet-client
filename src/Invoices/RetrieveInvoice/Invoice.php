<?php

namespace Samfelgar\FinnetClient\Invoices\RetrieveInvoice;

use DateTime;
use Spatie\DataTransferObject\DataTransferObject;

class Invoice extends DataTransferObject
{
    public string $firstMessage;
    public string $secondMessage;
    public Status $status;
    public string $bankIdentifier;
    public string $walletCode;
    public string $identifier;
    public DateTime $dueDate;
    public float $amount;

    /** @var Event[]|array */
    public array $events;

    public string $penaltyAmount;
    public int $discountAmount;
    public int $reducedAmount;
    public int $iofTaxAmount;
    public int $creditAmount;
    public string $creditDate;
}