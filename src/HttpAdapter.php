<?php

namespace Simplon\Http;

use Http\Client\HttpClient;

abstract class HttpAdapter
{
    /**
     * @var HttpClient
     */
    protected $httpAdapter;

    /**
     * @return HttpClient
     */
    public function getAdapter(): HttpClient
    {
        if (!$this->httpAdapter)
        {
            $this->httpAdapter = $this->getClient($this->getConfig());
        }

        return $this->httpAdapter;
    }

    /**
     * @return array
     */
    protected function getConfig(): array
    {
        return [
            'verify'  => false,
            'timeout' => 2,
        ];
    }

    /**
     * @param array $config
     *
     * @return HttpClient
     */
    abstract protected function getClient(array $config): HttpClient;
}