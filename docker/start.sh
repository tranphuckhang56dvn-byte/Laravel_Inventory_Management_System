#!/usr/bin/env bash
set -e

PORT="${PORT:-10000}"

# Configure Apache to listen on Render's dynamic $PORT (idempotent across restarts)
echo "Listen ${PORT}" > /etc/apache2/ports.conf
sed -i -E "s/<VirtualHost \*:[0-9]+>/<VirtualHost *:${PORT}>/g" /etc/apache2/sites-available/000-default.conf

# Build Laravel caches using runtime environment variables from Render
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations cleanly against TiDB Cloud / MySQL
php artisan migrate --force

# Auto-seed sample data only when users table is empty (first deploy)
USER_COUNT=$(php -r "require 'vendor/autoload.php'; (require 'bootstrap/app.php')->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap(); echo App\Models\User::count();")
if [ "$USER_COUNT" = "0" ]; then
    php artisan db:seed --force
fi

# Ensure Apache worker user owns runtime writable directories
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

exec apache2-foreground
