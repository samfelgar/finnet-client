<?php

namespace Samfelgar\FinnetClient\Exceptions;

use Exception;

class PaymentException extends Exception
{
    public static function paymentNotFound(): PaymentException
    {
        return new PaymentException('Payment not found');
    }
}