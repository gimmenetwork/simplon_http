<?php

namespace Simplon\Http\Strategies;

use Psr\Http\Message\ResponseInterface;

class JsonResponseStrategy
{
    /**
     * @param ResponseInterface $response
     *
     * @return array|null
     */
    public static function create(ResponseInterface $response): ?array
    {
        if (strpos($response->getHeaderLine('Content-type'), 'application/json') !== false)
        {
            $result = json_decode($response->getBody()->getContents(), true);

            if (is_array($result))
            {
                return $result;
            }
        }

        return null;
    }
}