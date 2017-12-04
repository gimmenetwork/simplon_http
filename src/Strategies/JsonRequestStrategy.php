<?php

namespace Simplon\Http\Strategies;

use Psr\Http\Message\RequestInterface;

class JsonRequestStrategy implements RequestStrategyInterface
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @param RequestInterface $response
     * @param array|null $body
     */
    public function __construct(RequestInterface $response, array $body = null)
    {
        $response->withHeader('Content-type', 'application/json');

        if ($body)
        {
            $response->getBody()->write(
                json_encode($body)
            )
            ;
        }

        $this->request = $response;
    }

    /**
     * @return RequestInterface
     */
    public function getRequest(): RequestInterface
    {
        return $this->request;
    }
}