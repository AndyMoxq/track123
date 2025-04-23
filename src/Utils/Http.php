<?php

namespace Track123\OpenApi\Utils;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Http
{
    /**
     *
     * @param $method
     * @param $url
     * @param array $body
     * @param array $headers
     * @param int $timeout
     * @return array|mixed
     */
    public static function request($method, $url, $body = [], $headers = [], $timeout = 60)
    {
        $client = new Client([
            'timeout' => $timeout,
            'http_errors' => false,
        ]);

        $options = [
            'headers' => $headers,
        ];

        $method = strtoupper($method);

        if (in_array($method, ['POST', 'PUT', 'PATCH'])) {
            $options['json'] = $body;
        } elseif ($method === 'GET' && !empty($body)) {
            $options['query'] = $body;
        }

        try {
            $response = $client->request($method, $url, $options);
            $statusCode = $response->getStatusCode();
            $content = $response->getBody()->getContents();
            $decoded = json_decode($content, true);

            return is_array($decoded) ? $decoded : ['raw' => $content, 'status' => $statusCode];
        } catch (GuzzleException $e) {
            throw new \RuntimeException("Guzzle error: " . $e->getMessage(), $e->getCode(), $e);
        }
    }
}
