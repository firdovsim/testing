<?php

namespace App\Data;

class AmazonOrder extends AbstractOrder
{
    protected function loadOrderData(int $id): array
    {
        $jsonFilePath = BASE_PATH . '/mock/order.16400.json';

        $jsonContents = file_get_contents($jsonFilePath);

        return json_decode($jsonContents, true);
    }

    public function getData(): ?array
    {
        return $this->data;
    }
}