#!/bin/sh
# wait-for-postgres.sh
set -e

host="$1"
PG_USER="$2"
POSTGRES_PASSWORD="$3"

until PGPASSWORD=$POSTGRES_PASSWORD psql -h "$host" -U $PG_USER  -d "app" -c '\q'; do
  >&2 echo "Postgres is unavailable - sleeping"
  sleep 1
done

>&2 echo "Postgres is up - executing command"
php artisan migrate
echo "Executing Artisan Developer Server"
php  artisan serve --host 0.0.0.0 --port 8000
