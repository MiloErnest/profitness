#!/bin/sh
set -e

php artisan storage:link --force 2>/dev/null || true
php artisan config:cache
php artisan route:cache
php artisan view:cache

if [ -n "${RUN_MIGRATIONS:-true}" ] && [ "${RUN_MIGRATIONS}" != "false" ]; then
    php artisan migrate --force
fi

exec php artisan serve --host=0.0.0.0 --port="${PORT:-8000}"
