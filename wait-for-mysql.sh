#!/bin/sh

# Wait until MySQL is ready
echo "⏳ Waiting for MySQL at $DB_HOST:$DB_PORT..."

until nc -z -v -w30 "$DB_HOST" "$DB_PORT"
do
  echo "❌ MySQL is unavailable - retrying in 3s..."
  sleep 3
done

echo "✅ MySQL is up!"
