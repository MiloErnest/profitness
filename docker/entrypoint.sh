#!/bin/sh
set -e

mkdir -p storage/framework/{cache,sessions,views} storage/logs bootstrap/cache
chmod -R a+rwX storage bootstrap/cache 2>/dev/null || true

php artisan storage:link --force 2>/dev/null || true

apply_pg_ssl_env() {
    case "${DB_CONNECTION:-}" in
        pgsql) ;;
        *) return 0 ;;
    esac

    case "${DB_SSLMODE:-prefer}" in
        require|verify-ca|verify-full|disable)
            export PGSSLMODE="${DB_SSLMODE}"
            ;;
        *)
            unset PGSSLMODE 2>/dev/null || true
            ;;
    esac
}

test_db_connection() {
    php -r "
require 'vendor/autoload.php';
\$app = require 'bootstrap/app.php';
\$kernel = \$app->make(Illuminate\Contracts\Console\Kernel::class);
\$kernel->bootstrap();
try {
    Illuminate\Support\Facades\DB::connection()->getPdo();
    exit(0);
} catch (Throwable \$e) {
    fwrite(STDERR, \$e->getMessage() . PHP_EOL);
    exit(1);
}
" 2>&1
}

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

    apply_pg_ssl_env

    max_attempts="${DB_WAIT_MAX_ATTEMPTS:-45}"
    sleep_seconds="${DB_WAIT_SLEEP_SECONDS:-2}"

    echo "Esperando base de datos (hasta $((max_attempts * sleep_seconds))s)..."
    attempt=1
    while [ "$attempt" -le "$max_attempts" ]; do
        if err=$(test_db_connection); then
            echo "Base de datos lista."
            return 0
        fi
        echo "Intento ${attempt}/${max_attempts}: ${err}"
        echo "Reintento en ${sleep_seconds}s..."
        sleep "$sleep_seconds"
        attempt=$((attempt + 1))
    done

    echo "ERROR: no se pudo conectar a la base de datos tras $((max_attempts * sleep_seconds))s."
    exit 1
}

PORT="${PORT:-8000}"

echo "Iniciando servidor HTTP en 0.0.0.0:${PORT} (Render port scan)..."
php artisan serve --host=0.0.0.0 --port="$PORT" &
SERVE_PID=$!

wait_for_db

php artisan config:cache

if [ -n "${RUN_MIGRATIONS:-true}" ] && [ "${RUN_MIGRATIONS}" != "false" ]; then
    php artisan migrate --force
fi

php artisan route:cache
php artisan view:cache

echo "Reiniciando servidor con configuración en caché..."
kill "$SERVE_PID" 2>/dev/null || true
wait "$SERVE_PID" 2>/dev/null || true

exec php artisan serve --host=0.0.0.0 --port="$PORT"
