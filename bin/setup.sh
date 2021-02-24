#!/bin/bash

if [ ! -d laravel ]; then
	echo "please run this command from root directory"
	exit 1
fi

cd laravel
composer install
cp .env.example .env
php artisan key:generate
touch $HOME/.pinker/database.sqlite
php artisan migrate --seed
php artisan config:cache
npm install
npm run dev

cd ..
npm install

