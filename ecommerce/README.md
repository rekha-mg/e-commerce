## E-commerce Application

An E-commerce Application is a project which will be used by the customer for buying the 
products and admin for managing the products and order details.

## Goals

## Laravel:
 Creating an Admin panel with the understanding of all the concepts such as integration 
of themes, migrations, seeders, validations, ORM, API, Passport/ JWT token
## Vue :
 Creating an Customer panel with the understanding of all the concepts with the 
integration of themes, use of API’s

## composer create-project laravel/laravel ecommerce
### php artisan make:model Role
### php artisan make:seeder Roleseeder
### php artisan db:seed --class=Roleseeder


### Display all users / employees
#### http://127.0.0.1:8000/api/users
### Display any one  users  on user_id/ employees
#### http://127.0.0.1:8000/api/users/1

### Display total customers
#### http://127.0.0.1:8000/api/customers
 
### Display perticular customers
####  http://127.0.0.1:8000/api/customer/1
### Add New User[ postman -params]
#### http://127.0.0.1:8000/api/customer?customer_id=3&customer_name=manu
#### Add address details
#### http://127.0.0.1:8000/api/customer?customer_id=2&first_name=kavya&last_name=shree&user_name=kavya&password=kavya123&phone=8876543276

 

# Installing UI comonents 


composer require laravel/ui
- This wont install if php version is less 7.4

php artisan ui vue
- This might give error related to js/ folder due to laravel 7 & 8 folder strcuture
- To fix it, copy public/js folder into resources/js
Ref: https://levelup.gitconnected.com/how-to-set-up-and-use-vue-in-your-laravel-8-app-2dd0f174e1f8
