<?php

namespace Simplon\Http\Strategies;

use Psr\Http\Message\ResponseInterface;

interface ResponseStrategyInterface
{
    /**
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response);
}