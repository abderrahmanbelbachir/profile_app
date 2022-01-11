#!/bin/sh

printf "Rename .env.example to .env for profile app project ...\n"
cp .env.docker.example .env

printf "composer install ... \n" ;
composer install

printf "npm  install ... \n" ;
npm install

printf "npm run dev ... \n" ;
npm run dev

printf "php artisan migrate ... \n" ;
php artisan migrate
