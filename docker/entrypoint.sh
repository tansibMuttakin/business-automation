#!/bin/bash
set -e

# Function to check if database is ready
function check_db() {
    php -r "
    \$host = getenv('DB_HOST') ?: 'db';
    \$port = getenv('DB_PORT') ?: '3306';
    \$user = getenv('DB_USERNAME') ?: 'root';
    \$password = getenv('DB_PASSWORD') ?: '';
    
    \$maxTries = 10;
    \$tries = 0;
    
    while (\$tries < \$maxTries) {
        try {
            new PDO(\"mysql:host=\$host;\$port\", \$user, \$password);
            exit(0);
        } catch (PDOException \$e) {
            echo 'Database connection failed. Retrying in 5 seconds...' . PHP_EOL;
            \$tries++;
            sleep(5);
        }
    }
    
    echo 'Database connection failed after multiple attempts' . PHP_EOL;
    exit(1);
    "
}

# Check if we should run migrations
if [[ "$SKIP_MIGRATIONS" != "true" ]]; then
    echo "Checking database connection..."
    check_db
    
    echo "Running migrations..."
    php artisan migrate --force
    
    # Check migration status
    if [ $? -eq 0 ]; then
        echo "Migrations completed successfully!"
    else
        echo "Migration failed! Exiting..."
        exit 1
    fi
else
    echo "Skipping migrations as per configuration"
fi

# Start PHP-FPM
echo "Starting PHP-FPM..."
exec php-fpm

