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
        new JsonRequestStrategy($request, [
            'token' => '00RVS2CI7K1S',
            'c'     => [
                'p' => 'unknown',
                'd' => null,
            ],
            'uh'    => '6e1550460435f0bfffaccd1fed25b6dc',
            'bh'    => 'c3845d2aca70fb9c9e93089ed1528176',
            'd'     => 'm',
        ]);

        $response = $this->http->sendRequest($request);

        if ($contents = (new JsonResponseStrategy($response))->getContents())
        {
            return $contents;
        }

        return null;
    }
}
