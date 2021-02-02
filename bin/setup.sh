#!/bin/bash

if [ ! -f index.js ]; then
	echo "please run this command from root directory"
fi

cd laravel
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
php artisan config:cache
npm install
npm run dev

cd ../psycho
composer install

cd ..
npm install

