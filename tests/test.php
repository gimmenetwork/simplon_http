<?php

use GuzzleHttp\Psr7\Request;
use Http\Adapter\Guzzle6\Client;
use Http\Client\HttpClient;
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
}

//
// send POST as JSON request
//

try
{
    $request = new Request('POST', 'http://someurl.com/1.0/register');
    new JsonStrategy($request, ['token' => 'XXX12345']);

    $response = (new GuzzleClient())->getAdapter()->sendRequest($request);
    var_dump($response->getBody()->getContents());
}
catch (Exception $e)
{
}
catch (\Http\Client\Exception $e)
{
}