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
     * @var array
     */
    private $config;

    /**
     * @param HttpInterface $http
     * @param array $config
     */
    public function __construct(HttpInterface $http, array $config)
    {
        $this->http = $http;
        $this->config = $config;
    }

    /**
     * @return array|null
     * @throws Exception
     * @throws \Http\Client\Exception
     */
    public function register(): ?array
    {
        $request = $this->http->buildRequest('POST', $this->config['url']);
        $response = $this->http->sendRequest(JsonRequestStrategy::create($request, $this->config['data']));

        if ($contents = JsonResponseStrategy::create($response))
        {
            return $contents;
        }

        return null;
    }
}
