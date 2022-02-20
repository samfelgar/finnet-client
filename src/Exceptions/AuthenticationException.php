<?php

namespace Samfelgar\FinnetClient\Exceptions;

class AuthenticationException extends \Exception
{
    public static function accessDenied(): AuthenticationException
    {
        return new AuthenticationException('The resource owner denied the request');
    }
}