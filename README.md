<pre>
     _                 _               _     _   _         
 ___(_)_ __ ___  _ __ | | ___  _ __   | |__ | |_| |_ _ __  
/ __| | '_ ` _ \| '_ \| |/ _ \| '_ \  | '_ \| __| __| '_ \ 
\__ \ | | | | | | |_) | | (_) | | | | | | | | |_| |_| |_) |
|___/_|_| |_| |_| .__/|_|\___/|_| |_| |_| |_|\__|\__| .__/ 
                |_|                                 |_|    
</pre>

# Example

```php
use Psr\Http\Message\ResponseInterface;
use Simplon\Http\Adapter\GuzzleHttp;
use Simplon\Http\HttpInterface;
use Simplon\Http\Strategies\JsonStrategy;

//
// some class
//

class SomeHttp
{
    /**
     * @var HttpInterface
     */
    private $http;

    /**
     * @param HttpInterface $http
     */
    public function __construct(HttpInterface $http)
    {
        $this->http = $http;
    }

    /**
     * @return ResponseInterface
     * @throws Exception
     * @throws \Http\Client\Exception
     */
    public function register(): ResponseInterface
    {
        $request = $this->http->buildRequest('POST', 'http://someapi.com/1.0/register');
        new JsonStrategy($request, ['token' => '00RVS2CI7K1S']);

        return $this->http->sendRequest($request);
    }
}

//
// send POST as JSON request
//

$foo = new SomeHttp(new GuzzleHttp());
var_dump($foo->register()->getBody()->getContents());
```

# License
Cirrus is freely distributable under the terms of the MIT license.

Copyright (c) 2017 Tino Ehrich ([tino@bigpun.me](mailto:tino@bigpun.me))

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.