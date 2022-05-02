Requirements:

php: ^php7.4

mysql database

composer

npm

---------------------------------------------------------------------
Laravel was used as the backend and vue js was used as the frontend.

How to set up and run:

clone repository: git clone https://github.com/SteveDevs/pf-movie-system.git

.env variables:

APP_URL=http://localhost

SESSION_DRIVER=cookie

SESSION_DOMAIN=localhost

SANCTUM_STATEFUL_DOMAINS=localhost:8000

DB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=3306

DB_DATABASE=

DB_USERNAME=

DB_PASSWORD=

composer install

npm install

php artisan key:generate

php artisan migrate --seed

npm run dev

To run client set up: npm run dev

To run server: php artisan serve

open url at: http://localhost:8000/

Register: http://localhost:8000/register

Login: http://localhost:8000/login

Movies playing: http://localhost:8000/plays

Click on book on http://localhost:8000/plays to book movie
Choose a time and number of tickets then save booking to book

To run all unit tests:./vendor/bin/phpunit

----------------------------------------------------------------------

Relevant files:

Backend:

app/Models : Models

app/Http/Requests * : Validations

app/Http/Resources * : handles returns for the api

app/Http/Controllers * : controllers for api

app/Http/Services/Api * : These files are to handle api controller actions

app/Traits * : All classes that are reused across application

config/app: timezone to south african timezone

database/migrations * : relationships and foreign keys are used to ensure data integrity

database/seeders * : initial data for application

routes * : api for the vue js api, web for the backend routing for the Sanctum auth and rendering the root page on views.dashboard

tests * : all the unit tests

Frontend:

resources/js * all vue js files




