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

*   API Postman Collection: [Postman Collection](https://documenter.getpostman.com/view/27334377/2s9YCAQpfu)

### Brief Description

-   A user can either register or login to gain access
-   Users can then add a new project
-   A project can have many tasks and a task can have multiple notes
-   Full CRUD operations for all entities (except users)

### Postman Collection

-   [Postman Collection](https://documenter.getpostman.com/view/27334377/2s9YCAQpfu)
-   It contains some documentation
-   Please select the dev environment as the active enviroment.

*   The dev environment has two variables:

-   baseUrl => The API base url
-   token => The auth token. This will be automatically filled after each login request is complete
