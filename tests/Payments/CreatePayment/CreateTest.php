<?php

namespace Samfelgar\FinnetClient\Tests\Payments\CreatePayment;

use DateTime;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Samfelgar\FinnetClient\Exceptions\PaymentException;
use Samfelgar\FinnetClient\Payments\CreatePayment\Company;
use Samfelgar\FinnetClient\Payments\CreatePayment\Create;
use Samfelgar\FinnetClient\Payments\CreatePayment\Payee;
use Samfelgar\FinnetClient\Payments\CreatePayment\Payment;
use Samfelgar\FinnetClient\Payments\CreatePayment\Payments;
use Samfelgar\FinnetClient\Payments\CreatePayment\Taxpayer;

class CreateTest extends TestCase
{
    public function testItCanCreateAPayment(): void
    {
        $handler = new MockHandler([
            $this->mockSuccessfulResponse(),
        ]);

        $handlerStack = HandlerStack::create($handler);

        $client = new Client(['handler' => $handlerStack]);

        $createService = new Create($client);

        $result = $createService->execute($this->payments());

        $this->assertIsString($result);
        $this->assertTrue($result === '123');
    }

    public function testItThrowsAnExceptionIfPaymentLengthIsInvalid(): void
    {
        $createService = new Create(new Client());

        $this->expectException(PaymentException::class);

        $createService->execute($this->paymentsWithInvalidLength());
    }

    public function testItThrowsAnPaymentExceptionIfAClientErrorOccurs(): void
    {
        $handler = new MockHandler([
            new Response(400),
        ]);

        $handlerStack = HandlerStack::create($handler);

        $client = new Client(['handler' => $handlerStack]);

        $createService = new Create($client);

        $this->expectException(PaymentException::class);

        $createService->execute($this->payments());
    }

    private function mockSuccessfulResponse(): ResponseInterface
    {
        $body = [
            'id' => '123'
        ];

        return new Response(200, [], json_encode($body));
    }

    public function payments(): Payments
    {
        $payments = new Payments();
        $payments->setCompany($this->company());
        $payments->addPayment($this->payment(), $this->payee(), $this->taxpayer());

        return $payments;
    }

    public function paymentsWithInvalidLength(): Payments
    {
        $payments = new Payments();
        $payments->setCompany($this->company());

        return $payments;
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