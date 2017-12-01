<?php

use Psr\Http\Message\ResponseInterface;
use Simplon\Http\HttpInterface;
use Simplon\Http\Strategies\JsonStrategy;

class SomeHttp
{
    /**
     * @var HttpInterface
     */
    private $http;

    /**
     * @param HttpInterface $http
     */
    public function __construct(HttpInterface $http)
    {
        $this->http = $http;
    }

    /**
     * @return ResponseInterface
     * @throws Exception
     * @throws \Http\Client\Exception
     */
    public function register(): ResponseInterface
    {
        $request = $this->http->buildRequest('POST', 'http://someapi.com/1.0/register');
        new JsonStrategy($request, ['token' => '00RVS2CI7K1S']);

        return $this->http->sendRequest($request);
    }
}
