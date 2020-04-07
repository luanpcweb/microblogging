#! /bin/bash

echo 'Run setup...'

echo ' - Docker Build'
docker-compose build

echo ' - Docker Up'
docker-compose up -d

echo 'Waiting 15 seconds..'
sleep 15

echo ' - Copy .env'
cp .env.example .env

echo 'Run composer PHP'
docker run --rm -v $(pwd):/app composer install

echo ' - Artisan Key Generate'
docker exec php /bin/sh -c 'php artisan key:generate'

echo ' - Artisan Migrate'
docker exec php /bin/sh -c 'php artisan migrate'

echo "Status:"
docker-compose ps | grep "nginx" | cut -d ";" -f 2

echo "End script"
