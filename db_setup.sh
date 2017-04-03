#!/bin/bash
# chmod +x db_setup.sh 



echo "Unlocking composer..."
rm composer.lock &> /dev/null
echo "Installing required composer files...(this could take some time)"
composer install &> /dev/null
echo "Dumping unecessary files..."
composer dumpautoload &> /dev/null
echo "Running all outstanding migrations..."
php artisan migrate &> /dev/null
echo "Seeding database..."
php artisan db:seed &> /dev/null
tput setaf 2; echo "Successful database setup."
