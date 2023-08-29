## Trivel

Unofficial [Tripay](https://tripay.co.id/) wrapper for laravel 

Maintained by [CV Nexteam Teknologi Indonesia](https://www.nexteam.id/)

### Usage

- Install it by using command : `composer require nexteam/trivel`

- Add configuration in your `.env` file like this : 

```
TRIVEL_BASE_URL="https://tripay.co.id/api-sandbox"
TRIVEL_API_KEY=...
TRIVEL_MERCHANT_CODE=...
TRIVEL_PRIVATE_KEY=...
```

- Don't forget to publish the `trivel-config` by run command : `php artisan vendor:publish trivel-config`

## Example

```php
<?php

use Nexteam\Trivel\Dto\Transaction\ClosedTransactionRequest;
use Nexteam\Trivel\Exception\TrivelException;
use Nexteam\Trivel\Transaction\TrivelClosedTransaction;

// create close (one-time) transaction
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
```
