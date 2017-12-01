<?php

namespace Simplon\Http;

use Http\Client\HttpAsyncClient;
use Http\Client\HttpClient;
use Psr\Http\Message\RequestInterface;

interface HttpInterface extends HttpClient, HttpAsyncClient
{
    /**
     * @param string $method
     * @param string $uri
     *
     * @return RequestInterface
     */
    public function buildRequest(string $method, string $uri): RequestInterface;
}