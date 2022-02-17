<?php

namespace Samfelgar\FinnetClient\Invoices\CreateInvoice;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Samfelgar\FinnetClient\Exceptions\InvoiceException;
use Samfelgar\FinnetClient\Exceptions\PaymentException;

class Create
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws InvoiceException
     */
    public function execute(Invoices $invoices)
    {
        $requestBody = $invoices->toArray();

        if (count($requestBody['invoices']) < 1) {
            throw InvoiceException::invalidInvoicesLength();
        }

        $endpoint = 'invoice';

        try {
            $response = $this->client->post($endpoint, [
                'json' => $requestBody
            ]);

            $body = json_decode($response->getBody(), true);

            return $body['id'];
        } catch (ClientException $exception) {
            throw new InvoiceException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }
}