# User, Role, and Permission Management API

This project provides a RESTful API built with Laravel for managing users, roles, and permissions. It includes user authentication via Laravel Passport and custom middleware for role-based access control. The API is designed to manage users, assign roles, and grant permissions to ensure secure access to resources.

# Features

User Management: Create, read, update, and delete users.
Role Management: Create, read, update, and delete roles, and assign permissions to roles.
Permission Management: Create, read, update, and delete permissions.
Authentication: Uses Laravel Passport for API authentication.
Role-Based Access Control: Custom middleware to check user roles and permissions before accessing protected routes.

# Used technologies
- PHP 8.2
- Composer
- Laravel 11
- MySQL
- Postman for testing API

# SSH key for cloning the repository 
git@github.com:NM-Sakib/web_UserManagementAPI.git

# Dependencies and environment files
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan passport:install --api
Add in user model :
"use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
}"
Seed db(optional):
php artisan db:seed --class=RoleAndPermissionSeeder

# API test
For Passport key:
php artisan passport:keys

Client authentication key for authorization in postman(Bearer token):
php artisan passport:client --personal
next : php artisan tinker
->$token = User::first()->createToken('YourAppName')->accessToken;

# Users API:

GET   {url}/api/users
POST  {url}/api/users
    Example JSON : 
    {
        "name": "John Doe",
        "email": "johndoe@example.com",
        "password": "password123"
        "roles":[2]
    }
PUT  {url}/api/users/{id}
    Example JSON : 
    {
        "name": "John updated",
    }
DELETE  {url}/api/users/{id}

# Roles API:
GET   {url}/api/roles
POST  {url}/api/roles
    Example JSON : 
    {
        "name": "Admin",
        "permissions": [1, 2, 3]
    }
PUT  {url}/api/roles/{id}
    Example JSON : 
    {
        "name": "Super Admin",
        "permissions": [1, 2]
    }
DELETE  {url}/api/roles/{id}

# Permissions API

GET   {url}/api/Permissions
POST  {url}/api/Permissions
    Example JSON : 
    {
        "name": "Edit articles"
    }
PUT  {url}/api/Permissions/{id}
    Example JSON : 
    {
        "name": "Articles only",
    }
DELETE  {url}/api/Permissions/{id}
