<?php

namespace Simplon\Http\Strategies;

use Psr\Http\Message\RequestInterface;

class JsonStrategy implements StrategyInterface
{
    /**
     * @param RequestInterface $request
     * @param array|null $body
     */
    public function __construct(RequestInterface $request, array $body = null)
    {
        $request->withHeader('Content-type', 'application/json');

        if ($body)
        {
            $request->getBody()->write(
                json_encode($body)
            )
            ;
        }
    }
}