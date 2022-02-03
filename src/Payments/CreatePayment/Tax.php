<?php

namespace Samfelgar\FinnetClient\Payments\CreatePayment;

use DateTime;
use Spatie\DataTransferObject\DataTransferObject;

class Tax extends DataTransferObject
{
    public ?int $code;
    public ?DateTime $calculationPeriod;
    public ?string $identifier;
    public ?int $installmentNumber;
    public ?int $activeDebtNumber;
    public ?string $fgtsIdentifier;
    public ?int $fgtsConnectivityNumber;
    public ?int $fgtsConnectivityNumberIdentifier;
}