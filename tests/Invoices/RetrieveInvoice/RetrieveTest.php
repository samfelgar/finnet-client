<?php

namespace Samfelgar\FinnetClient\Tests\Invoices\RetrieveInvoice;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Samfelgar\FinnetClient\Exceptions\InvoiceException;
use Samfelgar\FinnetClient\Invoices\RetrieveInvoice\Retrieve;

class RetrieveTest extends TestCase
{
    public function testItCanRetrieveParsedInvoices(): void
    {
        $handler = new MockHandler([
            $this->mockSuccessfulResponse(),
        ]);

        $handlerStack = HandlerStack::create($handler);

        $client = new Client(['handler' => $handlerStack]);

        $retriever = new Retrieve($client);

        $result = $retriever->execute('identifier');

        $this->assertIsArray($result);
    }

    public function testItThrowsAnExceptionIfInvoiceNotFound(): void
    {
        $handler = new MockHandler([
            new Response(404),
        ]);

        $handlerStack = HandlerStack::create($handler);

        $client = new Client(['handler' => $handlerStack]);

        $retriever = new Retrieve($client);

        $this->expectException(InvoiceException::class);

        $retriever->execute('invalid-identifier');
    }

    private function mockSuccessfulResponse(): ResponseInterface
    {
        $body = [
            'id' => 'fb3507f8-61e2-4939-b2cf-98c35d946cb7',
            '_offset' => '10',
            '_limit' => '10',
            '_total' => 23,
            'results' => [
                [
                    'company' => [
                        'bank_identifier' => 104,
                        'type' => '2',
                        'registered_number' => '084438011000148',
                        'bank_branch' => '01111',
                        'bank_branch_identifier' => '2',
                        'bank_agreement' => '444444',
                        'name' => 'CEDENTE TESTE'
                    ],
                    'invoices' => [
                        [
                            'invoice' => [
                                'message_1' => '',
                                'message_2' => '',
                                'status' => [
                                    'code' => '02',
                                    'description' => 'ENTRADA CONFIRMADA'
                                ],
                                'bank_identifier' => ' 14700000000012344',
                                'wallet_code' => '1',
                                'identifier' => '',
                                'due_date' => '2020-04-30',
                                'amount' => 359.21,
                                'events' => [
                                    [
                                        'code' => 'A4',
                                        'description' => 'PAGADOR DDA'
                                    ]
                                ],
                                'penalty_amount' => '000000000000000',
                                'discount_amount' => 0,
                                'reduced_amount' => 0,
                                'iof_tax_amount' => 0,
                                'credit_amount' => 0,
                                'credit_date' => ''
                            ],
                            'payer' => [
                                'type' => '1',
                                'registered_number' => '000012345678901',
                                'name' => 'PAGADOR TESTE'
                            ]
                        ],
                        [
                            'invoice' => [
                                'message_1' => '',
                                'message_2' => '',
                                'status' => [
                                    'code' => '02',
                                    'description' => 'ENTRADA CONFIRMADA'
                                ],
                                'bank_identifier' => ' 14700000000012343',
                                'wallet_code' => '1',
                                'identifier' => '',
                                'due_date' => '2020-04-16',
                                'amount' => 260.64,
                                'events' => [],
                                'penalty_amount' => '000000000000000',
                                'discount_amount' => 0,
                                'reduced_amount' => 0,
                                'iof_tax_amount' => 0,
                                'credit_amount' => 0,
                                'credit_date' => ''
                            ],
                            'payer' => [
                                'type' => '1',
                                'registered_number' => '000012345678901',
                                'name' => 'PAGADOR TESTE'
                            ]
                        ],
                        [
                            'invoice' => [
                                'message_1' => '',
                                'message_2' => '',
                                'status' => [
                                    'code' => '02',
                                    'description' => 'ENTRADA CONFIRMADA'
                                ],
                                'bank_identifier' => ' 14700000000012345',
                                'wallet_code' => '1',
                                'identifier' => '',
                                'due_date' => '2020-04-16',
                                'amount' => 301.93,
                                'events' => [
                                    [
                                        'code' => 'A4',
                                        'description' => 'PAGADOR DDA'
                                    ]
                                ],
                                'penalty_amount' => '000000000000000',
                                'discount_amount' => 0,
                                'reduced_amount' => 0,
                                'iof_tax_amount' => 0,
                                'credit_amount' => 0,
                                'credit_date' => ''
                            ],
                            'payer' => [
                                'type' => '1',
                                'registered_number' => '000012345678901',
                                'name' => 'PAGADOR TESTE'
                            ]
                        ],
                        [
                            'invoice' => [
                                'message_1' => '',
                                'message_2' => '',
                                'status' => [
                                    'code' => '02',
                                    'description' => 'ENTRADA CONFIRMADA'
                                ],
                                'bank_identifier' => ' 14700000000012346',
                                'wallet_code' => '1',
                                'identifier' => '',
                                'due_date' => '2020-04-16',
                                'amount' => 301.93,
                                'events' => [
                                    [
                                        'code' => 'A4',
                                        'description' => 'PAGADOR DDA'
                                    ]
                                ],
                                'penalty_amount' => '000000000000000',
                                'discount_amount' => 0,
                                'reduced_amount' => 0,
                                'iof_tax_amount' => 0,
                                'credit_amount' => 0,
                                'credit_date' => ''
                            ],
                            'payer' => [
                                'type' => '1',
                                'registered_number' => '000012345678901',
                                'name' => 'PAGADOR TESTE'
                            ]
                        ],
                        [
                            'invoice' => [
                                'message_1' => '',
                                'message_2' => '',
                                'status' => [
                                    'code' => '02',
                                    'description' => 'ENTRADA CONFIRMADA'
                                ],
                                'bank_identifier' => ' 14700000000012341',
                                'wallet_code' => '1',
                                'identifier' => '',
                                'due_date' => '2020-04-16',
                                'amount' => 633.42,
                                'events' => [
                                    [
                                        'code' => 'A4',
                                        'description' => 'PAGADOR DDA'
                                    ]
                                ],
                                'penalty_amount' => '000000000000000',
                                'discount_amount' => 0,
                                'reduced_amount' => 0,
                                'iof_tax_amount' => 0,
                                'credit_amount' => 0,
                                'credit_date' => ''
                            ],
                            'payer' => [
                                'type' => '1',
                                'registered_number' => '000012345678901',
                                'name' => 'PAGADOR TESTE'
                            ]
                        ],
                        [
                            'invoice' => [
                                'message_1' => '',
                                'message_2' => '',
                                'status' => [
                                    'code' => '09',
                                    'description' => 'BAIXA'
                                ],
                                'bank_identifier' => ' 14700000000012334',
                                'wallet_code' => '1',
                                'identifier' => '',
                                'due_date' => '2020-04-15',
                                'amount' => 185.65,
                                'events' => [
                                    [
                                        'code' => '12',
                                        'description' => 'DECURSO PRAZO – CLIENTE'
                                    ]
                                ],
                                'penalty_amount' => '000000000000000',
                                'discount_amount' => 0,
                                'reduced_amount' => 0,
                                'iof_tax_amount' => 0,
                                'credit_amount' => 0,
                                'credit_date' => ''
                            ],
                            'payer' => [
                                'type' => '1',
                                'registered_number' => '000012345678901',
                                'name' => 'PAGADOR TESTE'
                            ]
                        ],
                        [
                            'invoice' => [
                                'message_1' => '',
                                'message_2' => '',
                                'status' => [
                                    'code' => '09',
                                    'description' => 'BAIXA'
                                ],
                                'bank_identifier' => ' 14700000000012265',
                                'wallet_code' => '1',
                                'identifier' => '',
                                'due_date' => '2020-04-15',
                                'amount' => 235.37,
                                'events' => [
                                    [
                                        'code' => '12',
                                        'description' => 'DECURSO PRAZO – CLIENTE'
                                    ]
                                ],
                                'penalty_amount' => '000000000000000',
                                'discount_amount' => 0,
                                'reduced_amount' => 0,
                                'iof_tax_amount' => 0,
                                'credit_amount' => 0,
                                'credit_date' => ''
                            ],
                            'payer' => [
                                'type' => '1',
                                'registered_number' => '000012345678901',
                                'name' => 'PAGADOR TESTE'
                            ]
                        ],
                        [
                            'invoice' => [
                                'message_1' => '',
                                'message_2' => '',
                                'status' => [
                                    'code' => '09',
                                    'description' => 'BAIXA'
                                ],
                                'bank_identifier' => ' 14700000000012266',
                                'wallet_code' => '1',
                                'identifier' => '',
                                'due_date' => '2020-04-15',
                                'amount' => 287.06,
                                'events' => [
                                    [
                                        'code' => '12',
                                        'description' => 'DECURSO PRAZO – CLIENTE'
                                    ]
                                ],
                                'penalty_amount' => '000000000000000',
                                'discount_amount' => 0,
                                'reduced_amount' => 0,
                                'iof_tax_amount' => 0,
                                'credit_amount' => 0,
                                'credit_date' => ''
                            ],
                            'payer' => [
                                'type' => '1',
                                'registered_number' => '000012345678901',
                                'name' => 'PAGADOR TESTE'
                            ]
                        ],
                        [
                            'invoice' => [
                                'message_1' => '',
                                'message_2' => '',
                                'status' => [
                                    'code' => '09',
                                    'description' => 'BAIXA'
                                ],
                                'bank_identifier' => ' 14700000000012275',
                                'wallet_code' => '1',
                                'identifier' => '',
                                'due_date' => '2020-04-15',
                                'amount' => 515.57,
                                'events' => [
                                    [
                                        'code' => '12',
                                        'description' => 'DECURSO PRAZO – CLIENTE'
                                    ]
                                ],
                                'penalty_amount' => '000000000000000',
                                'discount_amount' => 0,
                                'reduced_amount' => 0,
                                'iof_tax_amount' => 0,
                                'credit_amount' => 0,
                                'credit_date' => ''
                            ],
                            'payer' => [
                                'type' => '1',
                                'registered_number' => '000012345678901',
                                'name' => 'PAGADOR TESTE'
                            ]
                        ],
                        [
                            'invoice' => [
                                'message_1' => '',
                                'message_2' => '',
                                'status' => [
                                    'code' => '09',
                                    'description' => 'BAIXA'
                                ],
                                'bank_identifier' => ' 14700000000012264',
                                'wallet_code' => '1',
                                'identifier' => '',
                                'due_date' => '2020-04-15',
                                'amount' => 287.88,
                                'events' => [
                                    [
                                        'code' => '12',
                                        'description' => 'DECURSO PRAZO – CLIENTE'
                                    ]
                                ],
                                'penalty_amount' => '000000000000000',
                                'discount_amount' => 0,
                                'reduced_amount' => 0,
                                'iof_tax_amount' => 0,
                                'credit_amount' => 0,
                                'credit_date' => ''
                            ],
                            'payer' => [
                                'type' => '1',
                                'registered_number' => '000012345678901',
                                'name' => 'PAGADOR TESTE'
                            ]
                        ]
                    ]
                ]
            ],
            'links' => [
                [
                    'rel' => 'self',
                    'method' => 'GET',
                    'href' => 'https =>//openbanking-homol.finnet.com.br/v1/invoice/fb3507f8-61e2-4939-b2cf-98c35d946cb7/?_offset=10&_limit=10'
                ],
                [
                    'rel' => 'next',
                    'method' => 'GET',
                    'href' => 'https =>//openbanking-homol.finnet.com.br/v1/invoice/fb3507f8-61e2-4939-b2cf-98c35d946cb7/?_offset=20&_limit=10'
                ]
            ]
        ];

        return new Response(200, [], json_encode($body));
    }
}