<?php

namespace Simplon\Http\Adapter;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Http\Client\Exception\HttpException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Simplon\Http\HttpInterface;

class CurlHttp implements HttpInterface
{
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

    /**
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     * @throws \Exception
     * @throws HttpException
     */
    public function sendAsyncRequest(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     * @throws \Exception
     * @throws HttpException
     */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $opt = [
            CURLOPT_URL            => $request->getUri(),
            CURLOPT_CUSTOMREQUEST  => $request->getMethod(),
            CURLOPT_RETURNTRANSFER => 1,
        ];

        $request->getBody()->rewind();

        if (in_array($request->getMethod(), ['POST', 'PUT', 'PATHC', 'DELETE']))
        {
            $opt[CURLOPT_POST] = 1;
            $opt[CURLOPT_POSTFIELDS] = $request->getBody()->getContents();
        }

        return $this->request($opt);
    }

    /**
     * @param array $opt
     *
     * @return ResponseInterface
     */
    private function request(array $opt): ResponseInterface
    {
        $curl = curl_init();

        // add options to retrieve header
        $opt[CURLOPT_HEADER] = 1;
        curl_setopt_array($curl, $opt);

        // run request
        $response = curl_exec($curl);

        // parse header
        $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $header = $this->parseHttpHeaders(substr($response, 0, $header_size));

        // parse body
        $body = substr($response, $header_size);

        // cache error if any occurs
        $error = curl_error($curl);

        // cache http code
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        // url on which we eventually might have ended up (301 redirects)
        $lastUrl = curl_getinfo($curl, CURLINFO_EFFECTIVE_URL);

        curl_close($curl);

        return new Response($httpCode, $header, $body);
    }

    /**
     * @param string $headers
     *
     * @return array
     */
    private function parseHttpHeaders(string $headers): array
    {
        $data = [];
        $lines = explode("\r\n", chop($headers));
        $data['http-status'] = array_shift($lines);
        foreach ($lines as $line)
        {
            $parts = explode(':', $line);
            $data[strtolower(array_shift($parts))] = trim(join(':', $parts));
        }

        return $data;
    }
}