<?php

use GuzzleHttp\Psr7\Request;
use Http\Adapter\Guzzle6\Client;
use Http\Client\HttpClient;
use Psr\Http\Message\RequestInterface;
use Simplon\Http\HttpAdapter;
use Simplon\Http\Strategies\JsonStrategy;

require __DIR__ . '/../vendor/autoload.php';

//
// guzzle client example
//

class GuzzleClient extends HttpAdapter
{
    /**
     * @param array $config
     *
     * @return HttpClient
     */
    protected function getClient(array $config): HttpClient
    {
        return Client::createWithConfig($config);
    }

    /**
     * @param string $method
     * @param string $uri
     *
     * @return RequestInterface
     */
    public function buildRequest(string $method, string $uri): RequestInterface
    {
        return new Request($method, $uri);
    }
}

//
// send POST as JSON request
//

try
{
    $http = new GuzzleClient();
    $request = $http->buildRequest('POST', 'http://someurl.com/1.0/register');
    new JsonStrategy($request, ['token' => '00RVS2CI7K1S']);

    $response = $http->getAdapter()->sendRequest($request);
    var_dump($response->getBody()->getContents());
}
catch (Exception $e)
{
}
catch (\Http\Client\Exception $e)
{
}