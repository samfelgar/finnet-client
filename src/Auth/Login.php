<?php

namespace Samfelgar\FinnetClient\Auth;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Samfelgar\FinnetClient\Exceptions\AuthenticationException;

class Login
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws AuthenticationException
     */
    public function authenticate(string $username, string $password): TokenResponse
    {
        try {
            $response = $this->client->post('/login', [
                'json' => [
                    'username' => $username,
                    'password' => $password,
                ],
            ]);

            $parsedResponse = json_decode($response->getBody(), true);

            if (empty($parsedResponse)) {
                throw new \RuntimeException('Invalid response from Finnet');
            }

            return new TokenResponse($parsedResponse['access_token'], $parsedResponse['refresh_token']);
        } catch (ClientException $exception) {
            if ($exception->getCode() === 401) {
                throw AuthenticationException::accessDenied();
            }

            throw $exception;
        }
    }
}
