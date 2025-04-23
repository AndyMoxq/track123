<?php

namespace Track123\OpenApi\Contracts;

use Track123\OpenApi\Exception\InvalidResponseException;
use Track123\OpenApi\Utils\Http;

abstract class Client
{
    /**
     * @var Config 配置
     */
    protected $config;

    /**
     * Client constructor.
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @param $uri
     * @return string
     */
    protected function getRequestUrl($uri)
    {
        return rtrim($this->config->getBaseUri(), '/') . '/' . ltrim($uri, '/');
    }

    /**
     * @param Request $request
     * @return array|mixed
     * @throws InvalidResponseException
     */
    protected function doRequest(Request $request)
    {
        $request->validate();
        $method = $request->getMethod();
        $headers = $request->getHeaders();
        $body = $request->getBody();

        $url = $this->getRequestUrl($request->getApiUri());
        if (strtolower($method) == 'get' && !empty($body)) {
            $url .= (stripos($url, '?') !== false ? '&' : '?') . http_build_query($body);
        }
        $defaultHeaders = [
            'Track123-Api-Secret' => $this->config->getToken(),
            'accept' => 'application/json',
            'content-type' => 'application/json',
        ];
        $headers = array_merge($defaultHeaders, $request->getHeaders());
        try {
            return Http::request($method, $url, strtolower($method) === 'get' ? [] : $body, $headers);
        } catch (\Exception $e) {
            throw new InvalidResponseException($e->getMessage(), $e->getCode(), $e);
        }
    }
}