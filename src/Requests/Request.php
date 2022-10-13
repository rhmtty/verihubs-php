<?php

namespace Rhmt\Verihubs\Requests;

class Request
{
    private $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    private function send($method, $endpoint, array $payloads = [])
    {
        if (count($payloads) > 0) {
            ksort($payloads);
        }

        $method = strtoupper($method);
        $headers = [
            'App-ID:' . $this->config->getAppId(),
            'API-Key:' . $this->config->getApiKey(),
            'accept: application/json',
            'content-type: application/json'
        ];

        $responseHeaders = [];
        $urlApi = $this->config->getBaseUrl() . $endpoint;

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $urlApi,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_FAILONERROR => false
        ]);

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payloads));
        }

        if ($this->config->isDevelopment()) {
            curl_setopt($ch, CURLOPT_VERBOSE, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HEADERFUNCTION, function ($curl, $header) use (&$responseHeaders) {
                $len = strlen($header);
                $header = explode(':', $header, 2);

                if (count($header) < 2) {
                    return $len;
                }

                $responseHeaders[trim($header[0])] = trim($header[1]);
                return $len;
            });
        }

        $raw = curl_exec($ch);
        $errors = curl_error($ch);

        curl_close($ch);

        $decoded = json_decode($raw);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $decoded = false;
            $errors = $errors ?: 'Unable to decode json response.';
        }

        $results = [
            'request' => [
                // 'api' => $urlApi,
                'endpoint' => $endpoint,
                'method' => $method,
                'headers' => $headers,
                'body' => $payloads,
            ],
            'response' => [
                'headers' => $responseHeaders,
                'body' => $decoded,
                'raw' => $raw,
                'errors' => $errors
            ],
        ];

        return json_encode($results);
    }

    public function get($endpoint, array $payloads = [])
    {
        return $this->send('GET', $endpoint, $payloads);
    }

    public function post($endpoint, array $payloads = [])
    {
        return $this->send('POST', $endpoint, $payloads);
    }
}
