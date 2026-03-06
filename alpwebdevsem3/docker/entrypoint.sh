#!/bin/bash
set -e

echo "🚀 Starting Laravel Docker Setup..."

# ── Install PHP dependencies if missing ──────────────────
if [ ! -f "vendor/autoload.php" ]; then
    echo "📦 Installing Composer dependencies..."
    composer install --no-interaction --prefer-dist --optimize-autoloader
fi

# ── Ensure storage directories exist and are writable ────
echo "📁 Setting up storage directories..."
mkdir -p storage/logs storage/framework/{cache,sessions,views}
chmod -R 775 storage bootstrap/cache

# ── Generate app key if not set ──────────────────────────
if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "" ]; then
    echo "⚙️  Generating application key..."
    php artisan key:generate --force
fi

# ── Run migrations ───────────────────────────────────────
echo "📦 Running migrations..."
php artisan migrate --force

# ── Clear and cache config ───────────────────────────────
echo "🔧 Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# ── Create storage link ─────────────────────────────────
echo "🔗 Creating storage link..."
php artisan storage:link --force 2>/dev/null || true

echo "✅ Laravel is ready!"

# Execute the main container command (php-fpm)
exec "$@"
