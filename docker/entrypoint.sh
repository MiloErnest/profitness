#!/bin/sh
set -e

mkdir -p storage/framework/{cache,sessions,views} storage/logs bootstrap/cache
chmod -R a+rwX storage bootstrap/cache 2>/dev/null || true

php artisan storage:link --force 2>/dev/null || true

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

    if [ "${DB_SSLMODE:-}" = "require" ] || [ "${DB_SSLMODE:-}" = "verify-full" ]; then
        export PGSSLMODE="${DB_SSLMODE}"
    fi

    max_attempts="${DB_WAIT_MAX_ATTEMPTS:-45}"
    sleep_seconds="${DB_WAIT_SLEEP_SECONDS:-2}"

    echo "Esperando base de datos (hasta $((max_attempts * sleep_seconds))s)..."
    attempt=1
    while [ "$attempt" -le "$max_attempts" ]; do
        if php artisan db:show --no-interaction > /dev/null 2>&1; then
            echo "Base de datos lista."
            return 0
        fi
        echo "Intento ${attempt}/${max_attempts}: reintento en ${sleep_seconds}s..."
        sleep "$sleep_seconds"
        attempt=$((attempt + 1))
    done

    echo "ERROR: no se pudo conectar a la base de datos tras $((max_attempts * sleep_seconds))s."
    exit 1
}

wait_for_db

php artisan config:cache

if [ -n "${RUN_MIGRATIONS:-true}" ] && [ "${RUN_MIGRATIONS}" != "false" ]; then
    php artisan migrate --force
fi

php artisan route:cache
php artisan view:cache

exec php artisan serve --host=0.0.0.0 --port="${PORT:-8000}"
