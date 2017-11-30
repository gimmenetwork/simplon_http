<?php

namespace Simplon\Http\Strategies;

use Psr\Http\Message\RequestInterface;

interface StrategyInterface
{
    /**
     * @param RequestInterface $request
     */
    public function __construct(RequestInterface $request);
}