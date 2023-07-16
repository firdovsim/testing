<?php

namespace App\Data;

class AmazonBuyer implements BuyerInterface
{
    public function loadBuyerData(): array
    {
        $jsonFilePath = BASE_PATH. '/mock/buyer.29664.json';

        $jsonContents = file_get_contents($jsonFilePath);

        return json_decode($jsonContents, true);
    }

    public function offsetExists($offset)
    {
        // TODO: Implement offsetExists() method.
    }

    public function offsetGet($offset)
    {
        // TODO: Implement offsetGet() method.
    }

    public function offsetSet($offset, $value)
    {
        // TODO: Implement offsetSet() method.
    }

    public function offsetUnset($offset)
    {
        // TODO: Implement offsetUnset() method.
    }
}