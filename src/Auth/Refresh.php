<?php

namespace Samfelgar\FinnetClient\Auth;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Samfelgar\FinnetClient\Exceptions\AuthenticationException;

class Refresh
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
    public function refreshAccessToken(string $refreshToken): TokenResponse
    {
        try {
            $response = $this->client->post('/login/refresh', [
                'json' => [
                    'refresh_token' => $refreshToken,
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
