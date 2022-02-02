<?php

namespace Samfelgar\FinnetClient\Payments\RetrievePayment;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Samfelgar\FinnetClient\Exceptions\PaymentException;

class Retrieve
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @throws GuzzleException
     * @throws PaymentException
     */
    public function execute(string $identifier, int $offset = 0, int $limit = 10): array
    {
        $endpoint = "payment/{$identifier}";

        try {
            $response = $this->client->get($endpoint, [
                'query' => [
                    '_offset' => $offset,
                    '_limit' => $limit,
                ]
            ]);

            $responseBody = json_decode($response->getBody(), true);

            $results = $this->parseResults($responseBody['results']);

            return [
                'id' => $responseBody['id'],
                'total' => $responseBody['_total'],
                'results' => $results,
            ];
        } catch (ClientException $exception) {
            if ($exception->getCode() === 404) {
                throw PaymentException::paymentNotFound();
            }

            throw $exception;
        }
    }

    private function parseResults(array $results): array
    {
        return array_map(function (array $result) {
            [
                'company' => $companyData,
                'payments' => $payments,
            ] = $result;

            $company = $this->parseCompanyData($companyData);

            $company->payments = $this->parsePaymentsData($payments);

            return $company;
        }, $results);
    }

    private function parseCompanyData(array $company): Company
    {
        return new Company([
            'bankIdentifier' => $company['bank_identifier'],
            'type' => $company['type'],
            'registeredNumber' => $company['registered_number'],
            'bankBranch' => $company['bank_branch'],
            'bankAccount' => $company['bank_account'],
            'bankAccountIdentifier' => $company['bank_account_identifier'],
            'name' => $company['name'],
            'address' => [
                'address' => $company['address'],
                'number' => $company['address_number'],
                'complement' => $company['address_complement'],
                'city' => $company['address_city'],
                'zipCode' => $company['address_zip_code'],
                'state' => $company['address_state'],
            ]
        ]);
    }

    private function parsePaymentsData(array $payments): array
    {
        return array_map(function (array $payment) {
            $parsed = [];

            $parsed[] = $this->payment($payment['payment']);

            $parsed[] = isset($payment['payee']) ? $this->payee($payment['payee']) : null;

            $parsed[] = isset($payment['taxpayer']) ? $this->taxpayer($payment['taxpayer']) : null;

            return $parsed;
        }, $payments);
    }

    private function payment(array $payment): Payment
    {
        return new Payment([
            'type' => $payment['type'],
            'identifier' => $payment['identifier'],
            'date' => $payment['date'],
            'amount' => $payment['amount'],
            'events' => $this->events($payment['events']),
            'bankAuthentication' => $payment['bank_authentication'] ?? null,
            'barCode' => $payment['bar_code'] ?? null,
            'dueDate' => $payment['due_date'] ?? null,
            'originalAmount' => $payment['original_amount'] ?? null,
            'tax' => $this->tax($payment),
            'penaltyAmount' => $payment['penalty_amount'] ?? null,
            'interestAmount' => $payment['interest_amount'] ?? null,
            'grossRevenue' => $payment['gross_revenue'] ?? null,
            'grossRevenuePercentage' => $payment['gross_revenue_percentage'] ?? null,
            'otherEntitiesAmount' => $payment['other_entities_amount'] ?? null,
            'currencyRestatementAmount' => $payment['currency_restatement_amount'] ?? null,
        ]);
    }

    /**
     * @return Event[]
     */
    private function events(array $events): array
    {
        return array_map(fn(array $event) => new Event($event), $events);
    }

    private function tax(array $tax): Tax
    {
        return new Tax([
            'code' => $tax['tax_code'] ?? null,
            'calculationPeriod' => $tax['tax_calculation_period'] ?? null,
            'identifier' => $tax['tax_identifier'] ?? null,
        ]);
    }

    private function payee(array $payee): Payee
    {
        return new Payee([
            'name' => $payee['name'],
            'bankIdentifier' => $payee['bank_identifier'] ?? null,
            'bankBranch' => $payee['bank_branch'] ?? null,
            'bankAccount' => $payee['bank_account'] ?? null,
            'bankAccountIdentifier' => $payee['bank_account_identifier'] ?? null,
            'registeredNumber' => $payee['registered_number'] ?? null,
        ]);
    }

    private function taxpayer($taxpayer): Taxpayer
    {
        return new Taxpayer([
            'name' => $taxpayer['name'],
            'identifier' => $taxpayer['identifier'],
            'type' => $taxpayer['type'] ?? null,
        ]);
    }
}