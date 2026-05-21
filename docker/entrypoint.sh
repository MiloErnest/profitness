#!/bin/sh
set -e

mkdir -p storage/framework/{cache,sessions,views} storage/logs bootstrap/cache
chmod -R a+rwX storage bootstrap/cache 2>/dev/null || true

php artisan storage:link --force 2>/dev/null || true
php artisan config:cache

wait_for_db() {
    case "${RUN_MIGRATIONS:-true}" in
        false|0|no|NO) return 0 ;;
    esac

    case "${DB_CONNECTION:-}" in
        pgsql|mysql|mariadb|sqlsrv) ;;
        *)
            [ -n "${DB_URL:-}" ] || return 0
            ;;
    esac

    echo "Esperando base de datos..."
    attempt=1
    max_attempts=30
    while [ "$attempt" -le "$max_attempts" ]; do
        if php artisan db:show --no-interaction > /dev/null 2>&1; then
            echo "Base de datos lista."
            return 0
        fi
        echo "Intento ${attempt}/${max_attempts}: reintento en 2s..."
        sleep 2
        attempt=$((attempt + 1))
    done

    echo "ERROR: no se pudo conectar a la base de datos tras 60s."
    exit 1
}

wait_for_db

if [ -n "${RUN_MIGRATIONS:-true}" ] && [ "${RUN_MIGRATIONS}" != "false" ]; then
    php artisan migrate --force
fi

php artisan route:cache
php artisan view:cache

exec php artisan serve --host=0.0.0.0 --port="${PORT:-8000}"
