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

 

