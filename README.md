php artisan migrate
php artisan db:seed --class=WebsiteSeeder

php artisan optimize && php artisan config:clear
php artisan queue:work
