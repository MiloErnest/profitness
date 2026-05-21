#!/bin/sh
set -e

mkdir -p storage/framework/{cache,sessions,views} storage/logs bootstrap/cache
chmod -R a+rwX storage bootstrap/cache 2>/dev/null || true

php artisan storage:link --force 2>/dev/null || true

validate_app_key() {
    if php -r "
\$key = getenv('APP_KEY') ?: '';
if (\$key === '') {
    fwrite(STDERR, 'APP_KEY vacía' . PHP_EOL);
    exit(1);
}
if (!str_starts_with(\$key, 'base64:')) {
    fwrite(STDERR, 'APP_KEY debe empezar por base64:' . PHP_EOL);
    exit(1);
}
\$raw = base64_decode(substr(\$key, 7), true);
if (\$raw === false || strlen(\$raw) !== 32) {
    fwrite(STDERR, 'APP_KEY: clave base64 inválida o longitud incorrecta (32 bytes)' . PHP_EOL);
    exit(1);
}
exit(0);
" 2>/dev/null; then
        return 0
    fi

    echo ""
    echo "ERROR: APP_KEY inválida o no configurada."
    echo "Render genera claves sin prefijo base64: — eso rompe cifrado y config:cache."
    echo ""
    echo "Corrección en Render Dashboard > Environment:"
    echo "  1. Elimina la variable APP_KEY incorrecta."
    echo "  2. En Shell del servicio: php artisan key:generate --show"
    echo "  3. Crea APP_KEY con el valor completo (debe empezar por base64:)."
    echo "  4. Guarda y redeploy."
    exit 1
}

stop_background_serve() {
    if [ -z "${SERVE_PID:-}" ]; then
        return 0
    fi
    if kill -0 "$SERVE_PID" 2>/dev/null; then
        echo "Deteniendo servidor temporal (PID ${SERVE_PID})..."
        kill -TERM "$SERVE_PID" 2>/dev/null || true
        attempt=0
        while kill -0 "$SERVE_PID" 2>/dev/null && [ "$attempt" -lt 50 ]; do
            sleep 0.2
            attempt=$((attempt + 1))
        done
        kill -9 "$SERVE_PID" 2>/dev/null || true
        wait "$SERVE_PID" 2>/dev/null || true
    fi
    SERVE_PID=
}

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
    stop_background_serve
    exit 1
}

PORT="${PORT:-8000}"

validate_app_key

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

echo "Iniciando servidor con configuración en caché..."
stop_background_serve

exec php artisan serve --host=0.0.0.0 --port="$PORT"
