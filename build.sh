#!/usr/bin/env bash
ENV=$1

if [ "$ENV" == "" ]; then
    echo "Missing environment value!";
    exit 1;
fi

echo "Begin Allegro Generator installation for environment: $ENV";

npm install;
node_modules/bower/bin/bower install --config.analytics=false;

if [ "$ENV" == "prod" ]; then
#    node node_modules/gulp/bin/gulp.js build;
    composer install --no-dev --optimize-autoloader --prefer-dist;
else
    node node_modules/gulp/bin/gulp.js build-$ENV;
    composer diagnose;
    composer install;
fi

echo "Installation complete.";
