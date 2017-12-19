<?php

namespace Simplon\Http\Adapter;


use GuzzleHttp\Psr7\Request;
use Http\Client\Curl\Client;
use Http\Client\Exception\HttpException;
use Http\Message\MessageFactory\DiactorosMessageFactory;
use Http\Message\MessageFactory\GuzzleMessageFactory;
use Http\Message\StreamFactory\DiactorosStreamFactory;
use Http\Message\StreamFactory\GuzzleStreamFactory;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Simplon\Http\HttpInterface;

class CurlHttp implements HttpInterface
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @param string $method
     * @param string $uri
     *
     * @return RequestInterface
     */
    public function buildRequest(string $method, string $uri): RequestInterface
    {
        return new Request($method, $uri);
    }

    /**
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     * @throws \Exception
     * @throws HttpException
     */
    public function sendAsyncRequest(RequestInterface $request): ResponseInterface
    {
        return $this->getClient()->sendAsyncRequest($request);
    }

    /**
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     * @throws \Exception
     * @throws HttpException
     */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        return $this->getClient()->sendRequest($request);
    }

    /**
     * @return Client
     */
    protected function getClient(): Client
    {
        if (!$this->client)
        {
            $this->client = new Client(new GuzzleMessageFactory(), new GuzzleStreamFactory());
        }

        return $this->client;
    }
}