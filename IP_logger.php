<?php
require 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class IP_Logger
{
    public function log_ip()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        return $this->get_ip_info($ip);
    }

    public function get_ip_info($ip)
    {
        $client = new Client();

        $response = $client->request('GET', 'https://user-ip-data-rest-api.p.rapidapi.com/?ip=' . $ip, [
            'headers' => [
                'x-rapidapi-host' => 'user-ip-data-rest-api.p.rapidapi.com',
                'x-rapidapi-key' => 'f9e57f828amshd963e76fe4aa193p1f24e6jsn390afa4788fe',
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        
        return [
            'country' => $data['country'] ?? '',
            'region' => $data['region'] ?? ''
        ];
    }
}
$ip_logger = new IP_Logger();
$ip_info = $ip_logger->log_ip();