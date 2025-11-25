<?php
require_once 'vendor/autoload.php';

// Set your secret key. Remember to switch to your live secret key in production!
// See your keys here: https://dashboard.stripe.com/apikeys
\Stripe\Stripe::setApiKey('sk_live_your_secret_key_here');

header('Content-Type: application/json');

try {
    // Get the raw POST data
    $json_str = file_get_contents('php://input');
    $json_obj = json_decode($json_str);
    
    // Create a PaymentIntent with amount and currency
    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => $json_obj->amount,
        'currency' => 'usd',
        'automatic_payment_methods' => [
            'enabled' => true,
        ],
        'metadata' => [
            'plan_type' => $json_obj->plan_type,
            'customer_name' => $json_obj->customer_name,
            'customer_email' => $json_obj->customer_email,
            'customer_phone' => $json_obj->customer_phone,
            'property_address' => $json_obj->property_address
        ]
    ]);
    
    // Send the client secret back to the client
    echo json_encode([
        'clientSecret' => $paymentIntent->client_secret,
        'paymentIntentId' => $paymentIntent->id
    ]);
    
} catch (\Stripe\Exception\ApiErrorException $e) {
    // Stripe-specific error
    http_response_code(500);
    echo json_encode(['error' => $e->getError()->message]);
} catch (Exception $e) {
    // General error
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>