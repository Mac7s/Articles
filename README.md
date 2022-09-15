composer install <br>
cp .env.example .env <br>
set the database in .env file and set mailtrap connecetion <br>
php artisan migrate --seed <br>
php artisan queue:work --tries=2<br>
set the sms service in .env file I use FarazSms and I write my own channel for notification in app/notification/FarazSmsChannel <b> you should write your own chanel and fix credit in .env file </b> <br>




