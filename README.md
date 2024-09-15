# laravel_simple_logger
A simple Laravel logger for routes action. This logger will log any action and ip from any user (or non logged).

## Installation

### [1] Copy
Copy all the content of `laravel` folder into your Laravel project.

### [2] Setting up

Edit your `app/Http/Kernel.php` and add in the `protected $routeMiddleware` this line:

```
'log.activity' => \App\Http\Middleware\LogActivity::class,
```

this will add the logger middleware provider. It will result in something like this:

```
protected $routeMiddleware = [

		// ..
		// Other middlewares
		// ..
		
        'log.activity' => \App\Http\Middleware\LogActivity::class,
    ];
```

Then you can run a migration:

```
php artisan migrate --path=/database/migrations/2024_09_13_000000_create_logs_table.php
```

Or you can simply execute the SQL query (MySQL) in the file `/database/migrations/logs.sql`

You are ready to go!

## Usage

To log anything that passes from a route, just add to the route:

```
->middleware('log.activity')
```

Example on login:

```
Route::post('login', [AuthenticatedSessionController::class, 'store'])->middleware('log.activity');
```

or on logout:

```
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout')->middleware('log.activity');
```
