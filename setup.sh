#!/bin/bash

# Function to check if a command exists
command_exists() {
    command -v "$1" >/dev/null 2>&1
}

# Check for required software
echo "Checking system requirements..."

# Check PHP version
if command_exists php; then
    php_version=$(php -v | grep -oP 'PHP \K[0-9]+\.[0-9]+')
    if [[ "$php_version" < "8.0" ]]; then
        echo "Error: PHP 8.0 or higher is required. Found PHP $php_version."
        exit 1
    else
        echo "PHP $php_version is installed."
    fi
else
    echo "Error: PHP is not installed."
    exit 1
fi

# Check MySQL version
if command_exists mysql; then
    mysql_version=$(mysql --version | grep -oP 'Ver \K[0-9]+\.[0-9]+')
    if [[ "$mysql_version" < "5.6" ]]; then
        echo "Error: MySQL 5.6 or higher is required. Found MySQL $mysql_version."
        exit 1
    else
        echo "MySQL $mysql_version is installed."
    fi
else
    echo "Error: MySQL is not installed."
    exit 1
fi

# Check Composer version
if command_exists composer; then
    composer_version=$(composer --version | grep -oP 'Composer version \K[0-9]+\.[0-9]+')
    if [[ "$composer_version" < "2.0" ]]; then
        echo "Error: Composer 2.0 or higher is required. Found Composer $composer_version."
        exit 1
    else
        echo "Composer $composer_version is installed."
    fi
else
    echo "Error: Composer is not installed."
    exit 1
fi

# Check for Apache2 or NGINX
if command_exists apache2 || command_exists nginx; then
    echo "Web server (Apache2 or NGINX) is installed."
else
    echo "Error: Apache2 or NGINX is not installed."
    exit 1
fi

# Installation steps
echo "Starting installation..."

# Install Composer dependencies
echo "Installing Composer dependencies..."
composer install

# Copy .env.example to .env
echo "Setting up environment variables..."
if [ -f ".env.example" ]; then
    cp .env.example .env
    echo ".env file created."
else
    echo "Error: .env.example file not found."
    exit 1
fi

# Import db.sql into the database
echo "Importing database..."
if [ -f "db.sql" ]; then
    read -p "Enter MySQL database name: " db_name
    read -p "Enter MySQL username: " db_user
    read -s -p "Enter MySQL password: " db_pass
    echo

    mysql -u "$db_user" -p"$db_pass" "$db_name" < db.sql
    if [ $? -eq 0 ]; then
        echo "Database imported successfully."
    else
        echo "Error: Failed to import database."
        exit 1
    fi
else
    echo "Error: db.sql file not found."
    exit 1
fi

echo "Installation completed successfully!"