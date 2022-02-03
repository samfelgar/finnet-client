<?php

namespace Samfelgar\FinnetClient\Tests\Payments\CreatePayment;

use DateTime;
use PHPUnit\Framework\TestCase;
use Samfelgar\FinnetClient\Payments\CreatePayment\Company;
use Samfelgar\FinnetClient\Payments\CreatePayment\Payee;
use Samfelgar\FinnetClient\Payments\CreatePayment\Payment;
use Samfelgar\FinnetClient\Payments\CreatePayment\Payments;
use Samfelgar\FinnetClient\Payments\CreatePayment\Taxpayer;

class PaymentsTest extends TestCase
{
    public function testItCanParseInformationToArray(): void
    {
        $payments = new Payments();
        $payments->setCompany($this->company());

        $payments->addPayment($this->paymentWithAllFieldsFilled());
        $payments->addPayment($this->payment(), $this->payee());
        $payments->addPayment($this->payment(), null, $this->taxpayer());

        $parsedPayments = $payments->toArray();

        $this->assertArrayHasKey('company', $parsedPayments);
        $this->assertArrayHasKey('payments', $parsedPayments);

        $paymentsArray = $parsedPayments['payments'];

        $this->assertCount(3, $paymentsArray);

        $this->assertArrayHasKey('payment', $paymentsArray[0]);

        $this->assertArrayHasKey('payment', $paymentsArray[1]);
        $this->assertArrayHasKey('payee', $paymentsArray[1]);

        $this->assertArrayHasKey('payment', $paymentsArray[2]);
        $this->assertArrayHasKey('taxpayer', $paymentsArray[2]);
    }

    private function company(): Company
    {
        return new Company([
            'bankIdentifier' => 1,
            'bankBranch' => 4590,
            'bankBranchIdentifier' => '0',
            'bankAccount' => 12016,
            'bankAccountIdentifier' => 'x',
            'bankAgreement' => '3333',
            'registeredNumber' => 48235916000157,
            'type' => 1,
            'name' => 'PAGADOR TESTE',
            'address' => [
                'address' => 'RUA TESTE',
                'number' => 123,
                'complement' => '456',
                'neighborhood' => 'BAIRRO TESTE',
                'city' => 'SAO PAULO',
                'state' => 'SP',
                'zipCode' => 9876543,
            ],
        ]);
    }

    private function paymentWithAllFieldsFilled(): Payment
    {
        return new Payment([
            'type' => 'TRANSFERENCIA_CONTA_CORRENTE',
            'identifier' => '111111111',
            'date' => DateTime::createFromFormat('Y-m-d', '2019-09-30'),
            'amount' => 20000002.5,
            'bankAuthentication' => '',
            'barCode' => '12345678901234567890123456789012345678901234',
            'dueDate' => DateTime::createFromFormat('Y-m-d', '2019-10-30'),
            'originalAmount' => 10000002.6,
            'tax' => [
                'code' => 1234,
                'calculationPeriod' => DateTime::createFromFormat('Y-m-d', '2019-11-30'),
                'identifier' => 'tax-identifier',
                'installmentNumber' => 1,
                'activeDebtNumber' => 1,
                'fgtsIdentifier' => 'fgts-identifier',
                'fgtsConnectivityNumber' => 1,
                'fgtsConnectivityNumberIdentifier' => 2,
            ],
            'penaltyAmount' => 11.11,
            'interestAmount' => 12.12,
            'grossRevenue' => 13.13,
            'grossRevenuePercentage' => 10.0,
            'otherEntitiesAmount' => 14.14,
            'currencyRestatementAmount' => 15.16,
            'stateRegistration' => 3,
        ]);
    }

    private function payment(): Payment
    {
        return new Payment([
            'type' => 'TRANSFERENCIA_CONTA_POUPANCA',
            'identifier' => '111111114',
            'date' => DateTime::createFromFormat('Y-m-d', '2019-03-30'),
            'amount' => 20000003.5,
            'bankAuthentication' => '',
        ]);
    }

    private function payee(): Payee
    {
        return new Payee([
            'name' => 'John Doe',
            'type' => 1,
            'registeredNumber' => 123
        ]);
    }

    private function taxpayer(): Taxpayer
    {
        return new Taxpayer([
            'type' => 1,
            'identifier' => 123,
            'name' => 'Jane Doe',
        ]);
    }
}