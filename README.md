composer install <br>
cp .env.example .env <br>
set the database in .env file and set mailtrap connecetion <br>
php artisan migrate --seed <br>
php artisan queue:work --tries=2<br>




