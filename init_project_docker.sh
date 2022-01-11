#!/bin/sh

printf "composer install ... \n" ;
composer install

printf "Rename .env.example to .env for profile app project ...\n"
cp .env.docker.example .env


printf "Cloning laradock ...\n"
git clone https://github.com/Laradock/laradock.git

printf "go to laradock ...\n"
cd laradock

printf "Rename .env.example to .env for laradock ...\n"
cp .env.example .env

printf "launch docker-composer build ... \n" ;
docker-compose build nginx mysql phpmyadmin redis workspace

printf "launch docker-composer up -d ... \n" ;
docker-compose up -d nginx mysql phpmyadmin redis workspace

printf "docker-compose exec workspace and run artisan migrate ... \n" ;
docker-compose exec workspace php artisan migrate

printf "php artisan seed ... \n" ;
docker-compose exec workspace php artisan db:seed --class=CompaignSeeder

printf "npm install ... \n" ;
docker-compose exec workspace npm install

printf "npm run dev  ... \n" ;
docker-compose exec workspace npm run dev 

