## This repo is a basic test repo. It is a simple task management project built with Laravel

### Setup

-   Pull/Clone the Repo
-   Run `composer install` to install all packages
-   To view logs, run `php artisan log-viewer:publish`. The logs will be availabe in {baseUrl}/log-viewer
-   Copy the .env.example file and save as .env
-   Setup the environment (Database)
-   Run `php artisan migrate` to create needed database tables
-   Run `php artisan serve` to start the backend service

*   Please note: BASIC AND EXPECTED EXCEPTIONS (LIKE MethodNotAllowedHttpException, NotFoundHttpException, ModelNotFoundException) are handled in app/Exceptions/Handler.php
*   API Postman Collection:
