<?php

use Simplon\Http\HttpInterface;
use Simplon\Http\Strategies\JsonRequestStrategy;
use Simplon\Http\Strategies\JsonResponseStrategy;

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
     * @return array|null
     * @throws Exception
     * @throws \Http\Client\Exception
     */
    public function register(): ?array
    {
        $request = $this->http->buildRequest('POST', 'http://someapi.com/1.0/register');
        new JsonRequestStrategy($request, ['token' => '00RVS2CI7K1S']);

        $response = $this->http->sendRequest($request);

        if ($contents = (new JsonResponseStrategy($response))->getContents())
        {
            return $contents;
        }

        return null;
    }
}
