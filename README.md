# Tots Auth - Laravel

This library provides all the functionality needed to easily integrate JWT Token authentication, including migrations, models, and controllers. It's a simpler alternative to other libraries that include many additional methods or make the process more complex.

## 💻 Install

* Open composer.json
* Copy "repositories"
```json 
"repositories": [
    {
        "type": "git",
        "url": "https://github.com/tots-agency/tots-auth-laravel.git"
    }
]
```
* Add require
```json 
"require": {
    "php": "^8.1",
    "laravel/framework": "^10.10",
    "tots/auth-laravel": "dev-main",
    ...
},
```
* Abrir archivo: config/app.php
* Sumar el Provider
```php
'providers' => ServiceProvider::defaultProviders()->merge([
    /// ...
    \Tots\Auth\Providers\AuthServiceProvider::class,
    /// ...
])->toArray(),
```
* Ejecutar migraciones:
```bash
php artisan migrate
```

## Use Middlewares
* Open file: app/Http/Kernel.php
* Add
```php
protected $middlewareAliases = [
    'auth' => \Tots\Auth\Http\Middleware\AuthMiddleware::class,
    'auth-optional' => \Tots\Auth\Http\Middleware\AuthOptionalMiddleware::class,
    /// ...
];
```
* Add in route
```php
Route::get('/users/me', ['middleware' => 'auth', 'uses' => \App\Http\Controllers\UserController::class . '@me']);
```

### AuthMiddleware - auth

Checks if an Access Token has been sent in the Header and sets the User in the platform. If it’s invalid or not sent, it will return a 401 error.

### AuthOptionalMiddleware - auth-optional

Performs the same action, but if the user cannot be retrieved, it doesn’t throw an exception and allows the flow to continue.

## Use Controllers

### Login - Create Access Token

* Send email and password and return Access Token
```php
Route::post('/oauth/token', ['uses' => \Tots\Auth\Http\Controllers\Basic\LoginController::class . '@login']);
```