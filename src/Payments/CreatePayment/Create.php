<?php

namespace Samfelgar\FinnetClient\Payments\CreatePayment;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
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
     * @throws PaymentException
     */
    public function execute(Payments $payments): string
    {
        $requestBody = $payments->toArray();

        if (count($requestBody['payments']) < 1) {
            throw PaymentException::invalidPaymentsLength();
        }

        $endpoint = 'payment';

        try {
            $response = $this->client->post($endpoint, [
                'json' => $requestBody
            ]);

            $body = json_decode($response->getBody(), true);

            return $body['id'];
        } catch (ClientException $exception) {
            throw new PaymentException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }
}