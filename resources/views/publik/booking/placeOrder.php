<?php


/*Install Midtrans PHP Library (https://github.com/Midtrans/midtrans-php)
composer require midtrans/midtrans-php

Alternatively, if you are not using **Composer**, you can download midtrans-php library
(https://github.com/Midtrans/midtrans-php/archive/master.zip), and then require
the file manually.

require_once dirname(__FILE__) . '/pathofproject/Midtrans.php'; */

//SAMPLE REQUEST START HERE

use Midtrans\Config;
// Set your Merchant Server Key
Config::$serverKey = config('Mid-server-PIrV6n166uSXMe2fEJQ03ag6');
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
Config::$isProduction = config('services.midtrans.is_production');
// Set sanitization on (default)
Config::$isSanitized = config('services.midtrans.is_sanitized');
// Set 3DS transaction for credit card to true
Config::$is3ds = config('services.midtrans.is_3ds');

$grossAmount = isset($_POST['amount']) ? (int) $_POST['amount'] : 0;
$itemDetails = isset($_POST['item_details']) ? json_decode($_POST['item_details'], true) : [];
$itemDetails = is_array($itemDetails) ? $itemDetails : [];

$customerName = $_POST['name'] ?? '';
$customerEmail = $_POST['email'] ?? '';
$customerPhone = $_POST['phone'] ?? '';

$params = array(
    'transaction_details' => array(
        'order_id' => 'ORDER-' . time() . '-' . random_int(1000, 9999),
        'gross_amount' => $grossAmount,
    ),
    'item_details' => $itemDetails,
    'customer_details' => array(
        'first_name' => $customerName,
        'email' => $customerEmail,
        'phone' => $customerPhone,
    ),
);

$snapToken = \Midtrans\Snap::getSnapToken($params);
echo $snapToken;
