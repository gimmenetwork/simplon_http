<?php

namespace Simplon\Http\Strategies;

use Psr\Http\Message\ResponseInterface;

class JsonResponseStrategy implements ResponseStrategyInterface
{
    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * @return array|null
     */
    public function getContents(): ?array
    {
        $result = json_decode($this->response->getBody()->getContents(), true);

        if (is_array($result))
        {
            return $result;
        }

        return null;
    }
}