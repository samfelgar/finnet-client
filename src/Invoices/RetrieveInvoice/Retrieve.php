<?php

namespace Samfelgar\FinnetClient\Invoices\RetrieveInvoice;

use DateTime;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Samfelgar\FinnetClient\Exceptions\InvoiceException;

class Retrieve
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function execute(string $identifier, int $offset = 0, int $limit = 10): array
    {
        $endpoint = "invoice/{$identifier}";

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
                throw InvoiceException::invoiceNotFound();
            }

            throw $exception;
        }
    }

    private function parseResults(array $results): array
    {
        return array_map(function (array $result) {
            ['company' => $companyData, 'invoices' => $invoices] = $result;

            $company = $this->parseCompany($companyData);
            $company->invoices = $this->parseInvoices($invoices);

            return $company;
        }, $results);
    }

    private function parseCompany(array $company): Company
    {
        return new Company([
            'bankIdentifier' => $company['bank_identifier'],
            'type' => $company['type'],
            'registeredNumber' => $company['registered_number'],
            'bankBranch' => $company['bank_branch'],
            'bankBranchIdentifier' => $company['bank_branch_identifier'],
            'bankAgreement' => $company['bank_agreement'],
            'name' => $company['name'],
        ]);
    }

    private function parseInvoices(array $invoices): array
    {
        return array_map(function (array $invoiceData) {
            ['invoice' => $invoice, 'payer' => $payer] = $invoiceData;

            return [
                'invoice' => $this->parseInvoice($invoice),
                'payer' => $this->parsePayer($payer),
            ];
        }, $invoices);
    }

    private function parseInvoice(array $invoice): Invoice
    {
        return new Invoice([
            'firstMessage' => $invoice['message_1'],
            'secondMessage' => $invoice['message_2'],
            'status' => [
                'code' => $invoice['status']['code'],
                'description' => $invoice['status']['description'],
            ],
            'bankIdentifier' => $invoice['bank_identifier'],
            'walletCode' => $invoice['wallet_code'],
            'identifier' => $invoice['identifier'],
            'dueDate' => DateTime::createFromFormat('Y-m-d', $invoice['due_date']),
            'amount' => $invoice['amount'],
            'events' => $this->events($invoice['events']),
            'penaltyAmount' => $invoice['penalty_amount'],
            'discountAmount' => $invoice['discount_amount'],
            'reducedAmount' => $invoice['reduced_amount'],
            'iofTaxAmount' => $invoice['iof_tax_amount'],
            'creditAmount' => $invoice['credit_amount'],
            'creditDate' => $invoice['credit_date'],
        ]);
    }

    /**
     * @return Event[]
     */
    private function events(array $events): array
    {
        return array_map(fn(array $event) => new Event($event), $events);
    }

    private function parsePayer(array $payer): Payer
    {
        return new Payer([
            'type' => $payer['type'],
            'registeredNumber' => $payer['registered_number'],
            'name' => $payer['name'],
        ]);
    }
}