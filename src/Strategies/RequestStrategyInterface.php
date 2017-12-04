<?php

namespace Simplon\Http\Strategies;


use Psr\Http\Message\RequestInterface;

interface RequestStrategyInterface
{
    /**
     * @param RequestInterface $request
     */
    public function __construct(RequestInterface $request);

    /**
     * @return RequestInterface
     */
    public function getRequest(): RequestInterface;
}