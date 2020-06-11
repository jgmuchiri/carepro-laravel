## About TykCare

TykCare is a daycare management SAAS application build on Laravel and VueJS

## Features

- Platform owner admin interface
- Daycare owner admin interface
- Staff access
- Parent access
- Default starter website template

## Installation

`composer install`

`npm install`

`npm run dev`

`php artisan key:generate`

- IMPORTANT! Change your default email and password in `.env` file

`php artisan migrate --seed`

`php artisan passport:install`

`php artisan currency:manage add <currency>` example `php artisan currency:manage add USD`

`php artisan currency:update.`

`php artisan storage:link`

`php artisan vendor:publish`

## Dependencies

- Stripe API Keys
- Stripe Managed accounts

- Obtain Stripe API keys and add them to the `.env`

`php artisan serve`

- Register your first daycare
