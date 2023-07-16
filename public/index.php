<?php

define('BASE_PATH', dirname(__DIR__));

use App\AmazonShippingService;
use App\Data\AmazonBuyer;
use App\Data\AmazonOrder;

require dirname(__DIR__) .'/vendor/autoload.php';

$order = new AmazonOrder(16400);
$order->load();
$buyer = new AmazonBuyer();
$buyer->loadBuyerData();

$shippingService = new AmazonShippingService();
$trackingNumber = $shippingService->ship($order, $buyer);

print_r($trackingNumber);