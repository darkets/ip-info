<?php
declare(strict_types=1);

namespace App;

use GuzzleHttp\Client;

class IpInfoAPI
{
    const API_URL = 'https://ipinfo.io/%s/geo';

    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'verify' => false,
        ]);
    }

    public function fetchInfo(string $ip): ?IpInfo
    {
        $url = sprintf(self::API_URL, $ip);

        $response = $this->client->get($url);

        if ($response->getStatusCode() !== 200) {
            return null;
        }

        $data = json_decode((string)$response->getBody());

        if (empty($data)) {
            return null;
        }

        return new IpInfo(
            $data->ip,
            $data->city,
            $data->region,
            $data->country,
            $data->timezone
        );
    }
}
