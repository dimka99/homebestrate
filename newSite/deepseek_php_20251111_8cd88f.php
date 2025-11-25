<?php
// success.php
$payment_id = $_GET['payment_id'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful - HomeSale Direct</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1a365d 0%, #2b6cb0 100%);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .success-container {
            background: white;
            color: #2d3748;
            padding: 3rem;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            max-width: 500px;
        }
        .success-icon {
            font-size: 4rem;
            color: #38a169;
            margin-bottom: 1rem;
        }
        .btn {
            background: #e53e3e;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            margin-top: 1rem;
            cursor: pointer;
            transition: all 0.3s;
        }
        .btn:hover {
            background: #c53030;
            transform: translateY(-2px);
        }
        .payment-id {
            background: #f7fafc;
            padding: 10px;
            border-radius: 5px;
            font-family: monospace;
            margin: 1rem 0;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <h1>Payment Successful!</h1>
        <p>Thank you for choosing HomeSale Direct. Your payment has been processed successfully.</p>
        
        <?php if ($payment_id): ?>
        <div class="payment-id">
            Transaction ID: <?php echo htmlspecialchars($payment_id); ?>
        </div>
        <?php endif; ?>
        
        <p><strong>What happens next:</strong></p>
        <ul style="text-align: left; margin: 1rem 0;">
            <li>You'll receive a confirmation email within 5 minutes</li>
            <li>Our team will contact you within 24 hours to get started</li>
            <li>Check your email for login credentials and next steps</li>
        </ul>
        <a href="/" class="btn">Return to Homepage</a>
    </div>
</body>
</html>