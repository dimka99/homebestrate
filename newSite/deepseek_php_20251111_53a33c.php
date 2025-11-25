<?php
require_once 'vendor/autoload.php';
require_once 'config.php';

\Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

// Retrieve the request's body and parse it as JSON
$input = @file_get_contents('php://input');
$event = null;

try {
    $event = \Stripe\Event::constructFrom(
        json_decode($input, true)
    );
} catch(\UnexpectedValueException $e) {
    // Invalid payload
    http_response_code(400);
    exit();
}

// Handle the event
switch ($event->type) {
    case 'payment_intent.succeeded':
        $paymentIntent = $event->data->object;
        handlePaymentSuccess($paymentIntent);
        break;
    case 'payment_intent.payment_failed':
        $paymentIntent = $event->data->object;
        handlePaymentFailure($paymentIntent);
        break;
    default:
        echo 'Received unknown event type ' . $event->type;
}

http_response_code(200);

function handlePaymentSuccess($paymentIntent) {
    // Here you can:
    // - Send confirmation email
    // - Update your database
    // - Trigger onboarding process
    // - Notify your team
    
    $plan_type = $paymentIntent->metadata->plan_type ?? 'unknown';
    $customer_email = $paymentIntent->metadata->customer_email ?? '';
    
    error_log("Payment succeeded: " . $paymentIntent->id . " for plan: " . $plan_type);
    
    // Send confirmation email (pseudo-code)
    // sendConfirmationEmail($customer_email, $paymentIntent->id, $plan_type);
}

function handlePaymentFailure($paymentIntent) {
    $error = $paymentIntent->last_payment_error;
    error_log("Payment failed: " . $paymentIntent->id . " - " . ($error->message ?? 'Unknown error'));
}
?>