<?php

require '../vendor/autoload.php';
\Stripe\Stripe::setApiKey('sk_test_51IbU4OLE69AfjgiS6BRo1wcFvUkNUHaagNKmSdFx0JDDtABPsjS6eaQpiRljorn8AEccpy5NRjWVKKE0bhS4lRwj00VkOiCWBR');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost/skole/leap-glocal';

$checkout_session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => [[
        'price_data' => [
            'currency' => 'nok',
            'unit_amount' => 600,
            'product_data' => [
                'name' => 'Leap glocal medlemsskap',
                'images' => ["https://i.imgur.com/EHyR2nP.png"],
            ],
        ],
        'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => $YOUR_DOMAIN . '/success.html',
    'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
]);

echo json_encode(['id' => $checkout_session->id]);
