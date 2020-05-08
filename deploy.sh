mkdir -p storage/framework
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/framework/cache
mkdir -p bootstrap/cache
mkdir -p storage/logs
chmod -R 777 storage/
chmod -R 755 bootstrap/
npm i
npm run prod
composer install
