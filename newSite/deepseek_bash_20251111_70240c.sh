# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install dependencies
composer install

# Set proper permissions
chmod 755 payment.php
chmod 644 composer.json