<?php

namespace App;

use App\Data\AbstractOrder;
use App\Data\BuyerInterface;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

class AmazonShippingService implements ShippingServiceInterface
{
    private const API_ENDPOINT = 'https://sandbox.sellingpartnerapi-na.amazon.com';

    private Client $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client([
            'base_uri' => self::API_ENDPOINT,
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => ""
            ]
        ]);
    }

    public function ship(AbstractOrder $order, BuyerInterface $buyer): string
    {
        $payload = [

        ];

        $response = $this->sendFBARequest($payload);

        if ($response->getStatusCode() !== 200) {
            throw new RuntimeException('Failed to fulfill the order.');
        }

        $trackingNumber = $this->extractTrackingNumber($response);

        return $trackingNumber;
    }

    private function sendFBARequest(array $payload): ResponseInterface
    {
        try {
            $response = $this->httpClient->post('/fba/outbound/2020-07-01/fulfillmentOrders', [
                'json' => $payload,
            ]);


            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            throw new RuntimeException('Failed to communicate with FBA API');
        }
    }

    private function extractTrackingNumber($response): int
    {
        $trackingNumber = $response['payload']['trackingNumber'];

        return $trackingNumber;
    }
}