#!/bin/bash

if [ ! -f index.js ]; then
	echo "please run this command from root directory"
fi

cd laravel
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
npm install

cd ../psycho
composer install

cd ..
npm install

