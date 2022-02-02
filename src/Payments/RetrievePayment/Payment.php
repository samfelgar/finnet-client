<?php

namespace Samfelgar\FinnetClient\Payments\RetrievePayment;

use Spatie\DataTransferObject\DataTransferObject;

class Payment extends DataTransferObject
{
    public string $type;
    public string $identifier;
    public string $date;
    public float $amount;

    /** @var Event[]|array $events */
    public array $events;

    public ?string $bankAuthentication;
    public ?string $barCode;
    public ?string $dueDate;
    public ?float $originalAmount;
    public ?Tax $tax;
    public ?float $penaltyAmount;
    public ?float $interestAmount;
    public ?string $grossRevenue;
    public ?string $grossRevenuePercentage;
    public ?float $otherEntitiesAmount;
    public ?float $currencyRestatementAmount;
}