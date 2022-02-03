<?php

namespace Samfelgar\FinnetClient\Exceptions;

use Exception;

class PaymentException extends Exception
{
    public static function paymentNotFound(): PaymentException
    {
        return new PaymentException('Payment not found');
    }

    public static function invalidPaymentsLength(): PaymentException
    {
        return new PaymentException('The payments length does not meet minimum length of 1');
    }
}