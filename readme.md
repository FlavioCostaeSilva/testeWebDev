# TesteWebDev - by Flávio Costa e Silva
## Requisites
1. PHP 7.0
2. Composer

## Setup
1. Clone the project
2. Run command "composer install" on project path

## Setting up
1. Check presence of database file (database.sqlite) in path /storage/
2. Run the application with command line below:
* php artisan serve
3. Access via browser with address and port provided by last command
4. Turn on queue with command: 
* php artisan queue:listen database

Now insert a .xlsx file with products on same model provided!

## Functions
* Uploads .xslx files and makes post processing by queue, making creation and edition of products.
* Edits inserted product by clicking on "Edit" button.
* Excludes inserted product by clicking on "Delete" button.
* PLUS: You can edit your products direct on .xlsx file, keeping lm attribute equals on actual product recorded.