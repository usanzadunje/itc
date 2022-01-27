#!/bin/bash

php /var/www/artisan migrate:fresh --seed
php /var/www/artisan serve --host=0.0.0.0 --port=3000