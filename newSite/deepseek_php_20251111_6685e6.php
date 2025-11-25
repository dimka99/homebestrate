<?php
// Stripe Configuration
define('STRIPE_SECRET_KEY', 'sk_test_your_secret_key_here'); // Replace with your secret key
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_your_publishable_key_here'); // Replace with your publishable key
define('STRIPE_WEBHOOK_SECRET', 'whsec_your_webhook_secret_here'); // For webhooks

// Database configuration (optional - for storing payments)
define('DB_HOST', 'localhost');
define('DB_NAME', 'homesale_direct');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');

// Application settings
define('SITE_URL', 'https://yourdomain.com');
define('SUPPORT_EMAIL', 'support@homesaledirect.com');

// Enable error reporting for development
if ($_SERVER['SERVER_NAME'] === 'localhost') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}
?>