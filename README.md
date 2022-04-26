# *Manage Products*

A mini-project to manage products using Laravel.

There are two roles: admin, user

### Admins can

-Login

-Logout

-Manage categories:

- View all categories
- Create a new category
- Edit a category
- Show a category
- Delete a category         

-Manage products:

- View all products
- Create a new product
- Show a product



### User can

-Login

-Logout

-View products that have an assigned category

-Favorite a product 

-View the favorite products list

-Search products

- By product name
- By category name



*Note*

to login for the admin go to http://127.0.0.1:8000/admin/login, and use admin, 123 to login

to login for the user go to http://127.0.0.1:8000/, and use user, 123 to login

## Installation

Use the composer manager, apply these steps at the first time

composer install

#### Creating, and seeding the database

php artisan migrate

php artisan db:seed

## Run

php artisan serve