<?php

namespace Samfelgar\FinnetClient\Tests\Payments\RetrievePayment;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Samfelgar\FinnetClient\Exceptions\PaymentException;
use Samfelgar\FinnetClient\Payments\RetrievePayment\Company;
use Samfelgar\FinnetClient\Payments\RetrievePayment\Payee;
use Samfelgar\FinnetClient\Payments\RetrievePayment\Payment;
use Samfelgar\FinnetClient\Payments\RetrievePayment\Retrieve;
use Samfelgar\FinnetClient\Payments\RetrievePayment\Taxpayer;

class RetrieveTest extends TestCase
{
    public function testCanRetrieveParsedPayments(): void
    {
        $handler = new MockHandler([
            $this->mockSuccessfulResponse(),
        ]);

        $handlerStack = HandlerStack::create($handler);

        $client = new Client(['handler' => $handlerStack]);

        $retrieve = new Retrieve($client);

        $response = $retrieve->execute('identifier');

        $this->assertIsArray($response);
        $this->assertArrayHasKey('results', $response);

        foreach ($response['results'] as $result) {
            $this->assertInstanceOf(Company::class, $result);

            foreach ($result->payments as $paymentData) {
                [$payment, $payee, $taxpayer] = $paymentData;

                $this->assertInstanceOf(Payment::class, $payment);
                $this->assertTrue(is_null($payee) || $payee instanceof Payee);
                $this->assertTrue(is_null($taxpayer) || $taxpayer instanceof Taxpayer);
            }
        }
    }

    public function testItThrowsAPaymentExceptionIfIdIsNotFound(): void
    {
        $handler = new MockHandler([
            $this->mockNotFoundResponse(),
        ]);

        $handlerStack = HandlerStack::create($handler);

        $client = new Client(['handler' => $handlerStack]);

        $retrieve = new Retrieve($client);

        $this->expectException(PaymentException::class);

        $retrieve->execute('invalid-identifier');
    }

    private function mockSuccessfulResponse(): ResponseInterface
    {
        $body = [
            "id" => "00000000-0000-0000-0000-000000000002",
            "_offset" => "0",
            "_limit" => "10",
            "_total" => 15,
            "results" => [
                [
                    "company" => [
                        "bank_identifier" => 341,
                        "type" => "1",
                        "registered_number" => "82578466000133",
                        "bank_branch" => "01234",
                        "bank_account" => "000006789012",
                        "bank_account_identifier" => "3",
                        "name" => "PAGADOR TESTE",
                        "address" => "RUA TESTE",
                        "address_number" => "00123",
                        "address_complement" => "456",
                        "address_city" => "SAO PAULO",
                        "address_zip_code" => "09876543",
                        "address_state" => "SP"
                    ],
                    "payments" => [
                        [
                            "payment" => [
                                "type" => "TRANSFERENCIA_CONTA_CORRENTE",
                                "identifier" => "111111111",
                                "date" => "2019-09-30",
                                "amount" => 20000002.5,
                                "events" => [
                                    [
                                        "code" => "00",
                                        "description" => "PAGAMENTO EFETUADO"
                                    ]
                                ],
                                "bank_authentication" => "AUTENTICACAO BANCARIA"
                            ],
                            "payee" => [
                                "bank_identifier" => "341",
                                "bank_branch" => "9876",
                                "bank_account" => "000004321098",
                                "bank_account_identifier" => "7",
                                "name" => "FAVORECIDO TESTE",
                                "registered_number" => "00003442978297"
                            ]
                        ],
                        [
                            "payment" => [
                                "type" => "TRANSFERENCIA_CONTA_POUPANCA",
                                "identifier" => "111111114",
                                "date" => "2019-09-30",
                                "amount" => 20000003.5,
                                "events" => [
                                    [
                                        "code" => "AE",
                                        "description" => "DATA DE PAGAMENTO ALTERADA"
                                    ],
                                    [
                                        "code" => "AG",
                                        "description" => "NUMERO DO LOTE INVALIDO"
                                    ]
                                ]
                            ],
                            "payee" => [
                                "bank_identifier" => "000",
                                "bank_branch" => "9876",
                                "bank_account" => "000004321098",
                                "bank_account_identifier" => "7",
                                "name" => "FAVORECIDO TESTE",
                                "registered_number" => "00003442978297"
                            ]
                        ],
                        [
                            "payment" => [
                                "type" => "TED_OUTRA_TITULARIDADE",
                                "identifier" => "111111112",
                                "date" => "2019-10-01",
                                "amount" => 10000001.5,
                                "events" => [
                                    [
                                        "code" => "00",
                                        "description" => "PAGAMENTO EFETUADO"
                                    ]
                                ]
                            ],
                            "payee" => [
                                "bank_identifier" => "341",
                                "bank_branch" => "7654",
                                "bank_account" => "000002109876",
                                "bank_account_identifier" => "5",
                                "name" => "OUTRO FAVORECIDO TESTE",
                                "registered_number" => "72325406000155"
                            ]
                        ],
                        [
                            "payment" => [
                                "type" => "BOLETO",
                                "bar_code" => "34145678901234567890123456789012345678901234",
                                "due_date" => "2019-10-23",
                                "original_amount" => 10000002.6,
                                "date" => "2019-10-22",
                                "amount" => 10000001.5,
                                "identifier" => "111111115",
                                "events" => [
                                    [
                                        "code" => "00",
                                        "description" => "PAGAMENTO EFETUADO"
                                    ]
                                ]
                            ],
                            "payee" => [
                                "name" => "OUTRO FAVORECIDO TESTE"
                            ]
                        ],
                        [
                            "payment" => [
                                "type" => "BOLETO",
                                "bar_code" => "12345678901234567890123456789012345678901234",
                                "due_date" => "2019-10-23",
                                "original_amount" => 10000002.6,
                                "date" => "2019-10-22",
                                "amount" => 10000001.5,
                                "identifier" => "111111113",
                                "events" => [
                                    [
                                        "code" => "00",
                                        "description" => "PAGAMENTO EFETUADO"
                                    ]
                                ]
                            ],
                            "payee" => [
                                "name" => "OUTRO FAVORECIDO TESTE"
                            ]
                        ],
                        [
                            "payment" => [
                                "type" => "CODIGO_BARRAS",
                                "bar_code" => "858900010145000002971925480129000004924803952001",
                                "due_date" => "2019-10-30",
                                "amount" => 23000000.5,
                                "date" => "2019-10-29",
                                "identifier" => "111111116",
                                "events" => [
                                    [
                                        "code" => "00",
                                        "description" => "PAGAMENTO EFETUADO"
                                    ]
                                ]
                            ]
                        ],
                        [
                            "payment" => [
                                "type" => "CODIGO_BARRAS",
                                "bar_code" => "858900010145000002971925480129000004924803952001",
                                "due_date" => "2019-10-30",
                                "amount" => 23000000.5,
                                "date" => "2019-10-29",
                                "identifier" => "111111125",
                                "events" => [
                                    [
                                        "code" => "00",
                                        "description" => "PAGAMENTO EFETUADO"
                                    ]
                                ]
                            ]
                        ],
                        [
                            "payment" => [
                                "type" => "DARF",
                                "tax_code" => "1234",
                                "tax_calculation_period" => "2019-11-01",
                                "tax_identifier" => "00000000000987654",
                                "original_amount" => 13.13,
                                "penalty_amount" => 11.11,
                                "interest_amount" => 12.12,
                                "amount" => 45000000.6,
                                "due_date" => "2019-11-05",
                                "date" => "2019-11-04",
                                "identifier" => "111111117",
                                "events" => [
                                    [
                                        "code" => "00",
                                        "description" => "PAGAMENTO EFETUADO"
                                    ]
                                ]
                            ],
                            "taxpayer" => [
                                "type" => "1",
                                "identifier" => "00012345678901",
                                "name" => "CONTRIBUINTE TESTE DARF"
                            ]
                        ],
                        [
                            "payment" => [
                                "type" => "DARF_SIMPLES",
                                "tax_code" => "1234",
                                "tax_calculation_period" => "2019-11-01",
                                "gross_revenue" => "000001313",
                                "gross_revenue_percentage" => "1000",
                                "original_amount" => 13.13,
                                "penalty_amount" => 11.11,
                                "interest_amount" => 12.12,
                                "amount" => 45000000.6,
                                "due_date" => "2019-11-05",
                                "date" => "2019-11-04",
                                "identifier" => "111111118",
                                "events" => [
                                    [
                                        "code" => "00",
                                        "description" => "PAGAMENTO EFETUADO"
                                    ]
                                ]
                            ],
                            "taxpayer" => [
                                "type" => "1",
                                "identifier" => "00012345678901",
                                "name" => "CONTRIBUINTE TESTE DARFS"
                            ]
                        ],
                        [
                            "payment" => [
                                "type" => "GPS",
                                "tax_code" => "5678",
                                "tax_calculation_period" => "2019-11-01",
                                "original_amount" => 10.1,
                                "other_entities_amount" => 11.11,
                                "currency_restatement_amount" => 12.12,
                                "amount" => 33.33,
                                "date" => "2019-11-06",
                                "identifier" => "111111119",
                                "events" => [
                                    [
                                        "code" => "00",
                                        "description" => "PAGAMENTO EFETUADO"
                                    ]
                                ]
                            ],
                            "taxpayer" => [
                                "identifier" => "00012345678901",
                                "name" => "CONTRIBUINTE TESTE GPS"
                            ]
                        ]
                    ]
                ]
            ],
            "links" => [
                [
                    "rel" => "self",
                    "method" => "GET",
                    "href" => "https =>//openbanking-homol.finnet.com.br/v1/payment/00000000-0000-0000-0000-000000000002/?_offset=0&_limit=10"
                ],
                [
                    "rel" => "next",
                    "method" => "GET",
                    "href" => "https =>//openbanking-homol.finnet.com.br/v1/payment/00000000-0000-0000-0000-000000000002/?_offset=10&_limit=10"
                ]
            ]
        ];

        return new Response(200, [], json_encode($body));
    }

    private function mockNotFoundResponse(): ResponseInterface
    {
        return new Response(404);
    }
}