<?php

namespace Simplon\Http\Strategies;

use Psr\Http\Message\RequestInterface;

class JsonRequestStrategy
{
    /**
     * @param RequestInterface $request
     * @param array|null $body
     *
     * @return RequestInterface
     */
    public static function create(RequestInterface $request, array $body = null): RequestInterface
    {
        if ($body)
        {
            $request->getBody()->write(
                json_encode($body)
            )
            ;
        }

        return $request->withHeader('Content-type', 'application/json');
    }
}