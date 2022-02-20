<?php

namespace Samfelgar\FinnetClient;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;
use Samfelgar\FinnetClient\Auth\Login;
use Samfelgar\FinnetClient\Auth\TokenResponse;
use Samfelgar\FinnetClient\Invoices\CreateInvoice\Create as CreateInvoices;
use Samfelgar\FinnetClient\Invoices\RetrieveInvoice\Retrieve as RetrieveInvoices;
use Samfelgar\FinnetClient\Payments\CreatePayment\Create as CreatePayments;
use Samfelgar\FinnetClient\Payments\RetrievePayment\Retrieve as RetrievePayments;

class Finnet
{
    public const BASE_URI_SANDBOX = 'https://openbanking-homol.finnet.com.br/v1/';
    public const BASE_URI_PRODUCTION = 'https://openbanking.finnet.com.br/v1/';

    private bool $productionEnvironment = false;

    private static Finnet $instance;
    private TokenResponse $token;

    private function __construct()
    {
    }

    public static function create(): Finnet
    {
        if (!isset(self::$instance)) {
            self::$instance = new Finnet();
        }

        return self::$instance;
    }

    private function finnetClient(): Client
    {
        $handler = HandlerStack::create();

        $handler->push(Middleware::mapRequest(function (RequestInterface $request): RequestInterface {
            if (isset($this->token)) {
                return $request->withHeader('Authentication', 'Bearer ' . $this->token->getAccessToken());
            }

            return $request;
        }));

        return new Client([
            'base_uri' => $this->productionEnvironment ? self::BASE_URI_PRODUCTION : self::BASE_URI_SANDBOX,
            'timeout' => 30.0,
            'handler' => $handler,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]
        ]);
    }

    public function homologation(): Finnet
    {
        $this->productionEnvironment = false;

        return $this;
    }

    public function production(): Finnet
    {
        $this->productionEnvironment = true;

        return $this;
    }

    public function authenticate(string $username, string $password): Finnet
    {
        $this->token = (new Login($this->finnetClient()))->authenticate($username, $password);

        return $this;
    }

    public function createInvoicesService(): CreateInvoices
    {
        return new CreateInvoices($this->finnetClient());
    }

    public function retrieveInvoicesService(): RetrieveInvoices
    {
        return new RetrieveInvoices($this->finnetClient());
    }

    public function createPaymentsService(): CreatePayments
    {
        return new CreatePayments($this->finnetClient());
    }

    public function retrievePaymentsService(): RetrievePayments
    {
        return new RetrievePayments($this->finnetClient());
    }
}
