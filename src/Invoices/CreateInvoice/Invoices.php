<?php

namespace Samfelgar\FinnetClient\Invoices\CreateInvoice;

class Invoices
{
    private Company $company;
    private array $invoices = [];

    public function setCompany(Company $company): void
    {
        $this->company = $company;
    }

    public function addInvoice(
        Invoice $invoice,
        Payer $payer,
        ?Payee $payee = null,
        ?PrintingInfo $printingInfo = null,
        ?FiscalNote $fiscalNote = null,
        ?PaymentDetails $paymentDetails = null
    )
    {
        $this->invoices[] = [$invoice, $payer, $payee, $printingInfo, $fiscalNote, $paymentDetails];
    }

    public function toArray(): array
    {
        $invoices = array_map(function (array $invoiceData) {
            /**
             * @var Invoice $invoice
             * @var Payer $payer
             * @var Payee|null $payee
             * @var PrintingInfo|null $printingInfo
             * @var FiscalNote|null $fiscalNote
             * @var PaymentDetails|null $paymentDetails
             */
            [$invoice, $payer, $payee, $printingInfo, $fiscalNote, $paymentDetails] = $invoiceData;

            $data = [
                'invoice' => $invoice->toArray(),
                'payer' => $payer->toArray(),
                'payee' => $payee->toArray(),
                'printing_info' => isset($printingInfo) ? $printingInfo->toArray() : null,
                'fiscal_note' => isset($fiscalNote) ? $fiscalNote->toArray() : null,
                'payment_details' => isset($paymentDetails) ? $paymentDetails->toArray() : null,
            ];

            return array_filter($data, fn ($value) => $value !== null);
        },$this->invoices);

        return [
            'company' => $this->company,
            'invoices' => $invoices,
        ];
    }
}