<?php

use Nexteam\Trivel\Dto\Transaction\ClosedTransactionRequest;
use Nexteam\Trivel\Exception\TrivelException;
use Nexteam\Trivel\Transaction\TrivelClosedTransaction;

// for the detail see official tripay documentation here : https://tripay.co.id/developer?tab=transaction-create

$payload = [
    'method' => 'BRIVA',
    'merchant_ref' => "INV0001",
    'amount' => 500000,
    'customer_name' => 'Nama Pelanggan',
    'customer_email' => 'emailpelanggan@domain.com',
    'customer_phone' => '081234567890',
    'order_items' => [
        [
            'sku' => 'FB-06',
            'name' => 'Nama Produk 1',
            'price' => 500000,
            'quantity' => 1,
            'product_url' => 'https://tokokamu.com/product/nama-produk-1',
            'image_url' => 'https://tokokamu.com/product/nama-produk-1.jpg',
        ],

    ],
    'return_url' => 'https://domainanda.com/redirect',
    'expired_time' => (time() + (24 * 60 * 60)),
];

try {
    $data = TrivelClosedTransaction::make(new ClosedTransactionRequest($payload["merchant_ref"], $payload["amount"], $payload));
    $payCode = $data['pay_code'];
    $checkOutUrl = $data['checkout_url'];
    dd($data);
} catch (TrivelException $e) {
    // handling your exception here
}
