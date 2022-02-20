<?php

namespace Samfelgar\FinnetClient\Tests\Invoices\CreateInvoice;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Samfelgar\FinnetClient\Exceptions\InvoiceException;
use Samfelgar\FinnetClient\Invoices\CreateInvoice\Company;
use Samfelgar\FinnetClient\Invoices\CreateInvoice\Create;
use Samfelgar\FinnetClient\Invoices\CreateInvoice\FiscalNote;
use Samfelgar\FinnetClient\Invoices\CreateInvoice\Invoice;
use Samfelgar\FinnetClient\Invoices\CreateInvoice\Invoices;
use Samfelgar\FinnetClient\Invoices\CreateInvoice\Payee;
use Samfelgar\FinnetClient\Invoices\CreateInvoice\Payer;
use Samfelgar\FinnetClient\Invoices\CreateInvoice\PaymentDetails;
use Samfelgar\FinnetClient\Invoices\CreateInvoice\PrintingInfo;

class CreateTest extends TestCase
{
    public function testItCanCreateAnInvoice(): void
    {
        $handler = new MockHandler([
            $this->mockSuccessfulResponse(),
        ]);

        $handlerStack = HandlerStack::create($handler);

        $client = new Client(['handler' => $handlerStack]);

        $createService = new Create($client);

        $result = $createService->execute($this->invoices());

        $this->assertIsString($result);
        $this->assertTrue($result === '123');
    }

    public function testItThrowsAnExceptionIfInvoicesLengthIsInvalid(): void
    {
        $createService = new Create(new Client());

        $this->expectException(InvoiceException::class);

        $createService->execute($this->invoicesWithInvalidLength());
    }

    public function testItThrowsAnInvoiceExceptionIfAClientErrorOccurs(): void
    {
        $handler = new MockHandler([
            new Response(400),
        ]);

        $handlerStack = HandlerStack::create($handler);

        $client = new Client(['handler' => $handlerStack]);

        $createService = new Create($client);

        $this->expectException(InvoiceException::class);

        $createService->execute($this->invoices());
    }

    private function mockSuccessfulResponse(): ResponseInterface
    {
        $body = [
            'id' => '123'
        ];

        return new Response(200, [], json_encode($body));
    }

    private function invoices(): Invoices
    {
        $invoices = new Invoices();

        $invoices->setCompany($this->company());
        $invoices->addInvoice(
            $this->invoice(),
            $this->payer(),
            $this->payee(),
            $this->printingInfo(),
            $this->fiscalNote(),
            $this->paymentDetails()
        );

        return $invoices;
    }

    private function invoicesWithInvalidLength(): Invoices
    {
        $invoices = new Invoices();

        $invoices->setCompany($this->company());

        return $invoices;
    }

    private function company(): Company
    {
        return new Company([
            "bankIdentifier" => 1,
            "bankBranch" => 9,
            "bankBranchIdentifier" => "9",
            "bankAccount" => 9,
            "bankAccountIdentifier" => "9",
            "bankAgreement" => '9',
            "registeredNumber" => '48235916000157',
            "type" => 1,
            "name" => "COBRANCA BB",
            'address' => [
                "zipCode" => 9876543,
                "address" => "RUA TESTE",
                "number" => 123,
                "complement" => "456",
                "neighborhood" => "BAIRRO TESTE",
                "city" => "SAO PAULO",
                "state" => "SP"
            ],
        ]);
    }

    private function invoice(): Invoice
    {
        return new Invoice([
            "ourNumber" => "string",
            "titlePrefix" => "string",
            "walletVariation" => 0,
            "bordereauNumber" => 0,
            "invoiceType" => "string",
            "bankWalletCode" => 0,
            "transactionCode" => 0,
            "yourNumber" => "string",
            "titleDueDate" => "string",
            "titleAmount" => 0,
            "demandingBankBranch" => 0,
            "demandingBankBranchIdentifier" => "string",
            "titleType" => 0,
            "acceptance" => "string",
            "titleIssueDate" => "string",
            "firstInstruction" => 0,
            "secondInstruction" => 0,
            "latePaymentInterestPerDay" => 0,
            "discountLimitDate" => "string",
            "discountAmount" => 0,
            "iofAmount" => 0,
            "rebateValue" => 0,
            "drawerGuarantorName" => "string",
            "deadlineForProtest" => 0,
            "serviceLot" => 0,
            "recordSeqNumInLot" => 0,
            "sendingMovementCode" => 0,
            "bankBranch" => 0,
            "dacBankBranch" => "string",
            "bankAccount" => '0',
            "dacBankAccount" => "string",
            "dacBankBranchAccount" => "string",
            "titleBankIdentification" => 0,
            "titleFormOfRegistration" => 0,
            "documentType" => 1,
            "bankSlipEmissionId" => 0,
            "bankSlipDeliveryId" => "string",
            "billingDocumentNumber" => '0',
            "identifier" => "string",
            "dacDemandingBankBranch" => "string",
            "latePaymentInterestCode" => 0,
            "latePaymentInterestDate" => "string",
            "discountCode1" => 0,
            "discountLimitDate1" => "string",
            "discountAmount1" => 0,
            "iofTaxAmount" => 0,
            "titleIdentificationInCompany" => "string",
            "protestCode" => 0,
            "closeCode" => 0,
            "deadlineForClose" => 0,
            "currencyCode" => 0,
            "contractNumber" => 0,
            "registrationType" => "string",
            "registrationNumber" => 0,
            "drawerGuarantorRegistType" => 1,
            "drawerGuarantorRegistNumber" => '0',
            "correspClearingBankCode" => 0,
            "ourNumberAtCorrespBank" => '0',
            "discountCode2" => 0,
            "discountLimitDate2" => "string",
            "discountAmount2" => 0,
            "discountCode3" => 0,
            "discountLimitDate3" => "string",
            "discountAmount3" => 0,
            "penaltyCode" => "string",
            "penaltyDate" => "string",
            "penaltyValue" => 0,
            "informationToPayer" => "string",
            "message3" => "string",
            "message4" => "string",
            "payerOccurrenceCode" => 0,
            "bankCodeInDebtAccount" => 0,
            "debitBankBranch" => 0,
            "dacDebitBankBranch" => "string",
            "debitBankAccount" => 0,
            "dacDebitBankAccount" => "string",
            "dacDebitBankBranchAccount" => "string",
            "warningForAutomaticDebit" => 0,
            "amountPaid" => 0,
            "creditAmount" => 0,
            "otherExpenditures" => 0,
            "otherCredits" => 0,
            "payerOccurrenceDate" => "string",
            "occurrenceComplement" => "string",
            "tariffsCostsValues" => 0,
            "occurrenceReason" => "string",
            "creditDate" => "string",
            "occurrenceDate" => "string",
            "occurrenceValue" => 0
        ]);
    }

    private function payer(): Payer
    {
        return new Payer([
            "registrationType" => 2,
            "registrationNumber" => '40729475',
            "name" => "FINNET",
            "address" => "RUA FORMOSA, 145",
            "neighborhood" => "JARDIM PAULISTA",
            "zipCode" => 10100,
            "zipCodeSuffix" => 123,
            "city" => "SAO PAULO",
            "state" => "SP"
        ]);
    }

    private function payee(): Payee
    {
        return new Payee([
            "email" => "payee@finnet.com.br",
            "ddd" => 11,
            "mobileNumber" => 123456789
        ]);
    }

    private function printingInfo(): PrintingInfo
    {
        return new PrintingInfo([
            "lineNumber" => 4,
            "message" => "MENSAGEM DEFAULT",
            "characterType" => 1,
            "message5" => "MENSAGEM 5",
            "message6" => "MENSAGEM 6",
            "message7" => "MENSAGEM 7",
            "message8" => "MENSAGEM 8",
            "message9" => "MENSAGEM 9"
        ]);
    }

    private function fiscalNote(): FiscalNote
    {
        return new FiscalNote([
            "fiscalNoteNumber1" => "43191dfa4gf",
            "fiscalNoteValue1" => 492.97,
            "fiscalNoteDate1" => "2020-11-15",
            "danfeNf1AccessKey" => "5225154455646",
            "fiscalNoteNumber2" => "9474fadfa",
            "fiscalNoteValue2" => 1494.91,
            "fiscalNoteDate2" => "2020-11-18",
            "danfeNf2AccessKey" => "9492747261451",
            "fiscalNoteNumber3" => "9yu4fadfa",
            "fiscalNoteValue3" => 1994.91,
            "fiscalNoteDate3" => "2020-11-19",
            "fiscalNoteNumber4" => "9yu4fald1",
            "fiscalNoteValue4" => 8994.91,
            "fiscalNoteDate4" => "2020-12-29",
            "fiscalNoteNumber5" => "8yu4fald1",
            "fiscalNoteValue5" => 8874.91,
            "fiscalNoteDate5" => "2020-10-25"
        ]);
    }

    private function paymentDetails(): PaymentDetails
    {
        return new PaymentDetails([
            "paymentTypeIdentification" => 1,
            "amountOfPossiblePayments" => 5,
            "typeOfInformedValueMax" => 1,
            "maxValue" => 9391.09,
            "typeOfInformedValueMin" => 2,
            "minValue" => 4614.94
        ]);
    }
}