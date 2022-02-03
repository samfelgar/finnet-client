<?php

namespace Samfelgar\FinnetClient\Payments\CreatePayment;

class Payments
{
    private Company $company;
    private array $payments = [];

    public function setCompany(Company $company): void
    {
        $this->company = $company;
    }

    public function addPayment(Payment $payment, ?Payee $payee = null, ?Taxpayer $taxpayer = null): void
    {
        $this->payments[] = [$payment, $payee, $taxpayer];
    }

    public function toArray(): array
    {
        $payments = array_map(function (array $paymentData) {
            /**
             * @var Payment $payment
             * @var Payee|null $payee
             * @var Taxpayer|null $taxpayer
             */
            [$payment, $payee, $taxpayer] = $paymentData;

            $data = [
                'payment' => $payment->toArray(),
                'payee' => isset($payee) ? $payee->toArray() : null,
                'taxpayer' => isset($taxpayer) ? $taxpayer->toArray() : null,
            ];

            return array_filter($data, fn($value) => $value !== null);
        }, $this->payments);

        return [
            'company' => $this->company->toArray(),
            'payments' => $payments,
        ];
    }
}