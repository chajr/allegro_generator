#!/usr/bin/env bash
ENV=$1

echo "Begin Allegro Generator installation for environment: ";
echo "$ENV";

npm install;
bower install;

if [ "$ENV" == "prod" ]; then
    composer install --no-dev --optimize-autoloader --prefer-dist;
else
    composer diagnose;
    composer install;
fi

echo "Installation complete.";
