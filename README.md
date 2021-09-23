## Laravel MongoDB Index

Laravel backend for indexing/searching documents using mongo atlas

Laravel version: 8.54
PHP version: 7.4
Mongo DB version: 3.6.3

#### Installation

``` bash
git clone https://github.com/Elda3004/test-app.git
# go into app's directory
$ cd test-app
```
Copy .env.example into .env


``` bash
# serve with hot reload at localhost:8085
sudo docker-compose up -d
# install app's dependencies
$ composer install
# config laravel cache
$ php artisan key:generate
$ php artisan config:cache
$ php artisan migrate
```

#### Commands


``` bash
# Index command
php artisan add:index
# search document command
php artisan search:index
```
#### Index command

--The index command is used to add a new document to the collection. By executing php artisan add:index and giving the correct input to the command a query is processed which adds a new document in the collection

Example:

php artisan add:index

Input: 1 apple pear juice
Output: Ok: 1


Input: 2 butter milk salt
Output: Ok: 2

Input: 3 coffee
Output: Ok: 3

The search command is used to query collections

Example:
php artisan search:index

Input: (apple & butter) | coffee
Output: Query results: 1 2 3

Mongo shell access: mongosh "mongodb+srv://cluster0.jvp6l.mongodb.net/intelycare" --username elda-admin