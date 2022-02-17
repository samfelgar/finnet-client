<?php

namespace Samfelgar\FinnetClient\Exceptions;

use Exception;

class InvoiceException extends Exception
{
    public static function invoiceNotFound(): InvoiceException
    {
        return new InvoiceException('Invoice not fount');
    }

    public static function invalidInvoicesLength(): InvoiceException
    {
        return new InvoiceException('The invoices length does not meet minimum length of 1');
    }
}