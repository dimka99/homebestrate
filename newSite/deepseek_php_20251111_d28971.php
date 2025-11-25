<?php
// config.php
define('STRIPE_SECRET_KEY', 'sk_live_your_secret_key_here');
define('STRIPE_PUBLISHABLE_KEY', 'pk_live_your_publishable_key_here');
define('WEBHOOK_SECRET', 'whsec_your_webhook_secret_here');

// Database configuration (if you want to store payments)
define('DB_HOST', 'localhost');
define('DB_NAME', 'homesale_direct');
define('DB_USER', 'username');
define('DB_PASS', 'password');
?>