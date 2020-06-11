## About TykCare

TykCare is a daycare management SAAS application build on Laravel and VueJS

## Features

- Platform owner admin interface
- Daycare owner admin interface
- Staff access
- Parent access
- Default starter website template

## Dependencies

- Stripe API Keys
- Stripe Managed accounts

## Installation

`composer install`

`npm install`

`npm run dev`

- Copy `.env.example` to `.env`
- Fill all necessary variables in the `.env`
  - Obtain Stripe API keys and add them to the `.env`
  - Add you mail server credentials on `.env'

`php artisan key:generate`

- IMPORTANT! Change your default email and password in `.env` file

`php artisan migrate --seed`

`php artisan passport:install`

`php artisan currency:manage add <currency>` example `php artisan currency:manage add USD`

`php artisan currency:update.`

`php artisan storage:link`

`php artisan vendor:publish`

`php artisan serve`

- Register your first daycare
