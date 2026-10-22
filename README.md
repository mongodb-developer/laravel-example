# laravel-example

Companion code for the MongoDB and Laravel tutorial.

- Read the full tutorial: [MongoDB and Laravel integration](https://www.mongodb.com/resources/products/compatibilities/mongodb-laravel-integration)
- Watch the video: [Getting Started with Laravel and MongoDB](https://learn.mongodb.com/courses/getting-started-with-laravel-and-mongodb)

## Compatibility

These files target:

- PHP 8.3 or later
- Laravel 12.51 or later, or Laravel 13
- mongodb/laravel-mongodb 5.11
- ext-mongodb 1.21 or later, or 2.x

See the [compatibility matrix](https://www.mongodb.com/docs/drivers/php/laravel-mongodb/current/compatibility/) for the full list of supported versions.

## Environment

Add the MongoDB connection to the `.env` file of your application:

```
DB_CONNECTION=mongodb
MONGODB_URI="mongodb+srv://<username>:<password>@<cluster-host>/myappdb?retryWrites=true&w=majority"
```

The `dsn` option reads `MONGODB_URI`, falls back to a local MongoDB server at `127.0.0.1:27017`, and the connection uses the `myappdb` database, as shown in `myapp/config/database.php`.

## API routes

Laravel does not create `routes/api.php` by default. Run the following command before copying `myapp/routes/api.php`:

```
php artisan install:api
```

The command creates the API route file and registers it in `bootstrap/app.php`.

## Tests

The GitHub Actions workflow creates a Laravel 13 application, installs mongodb/laravel-mongodb 5.11, copies these files and runs the feature tests in `myapp/tests` against a MongoDB service.

## Laravel MongoDB Documentation

Official documentation for Laravel MongoDB integration is available here: [Laravel MongoDB documentation](https://www.mongodb.com/docs/drivers/php/laravel-mongodb/)

## Disclaimer

Use at your own risk; not a supported MongoDB product
