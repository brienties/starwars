# Star Wars Api - Laravel Test

IT Exercise for getting data from the Swapi

```url
https://swapi.dev/documentation
```

## Installation

After getting the code from Github, download all the dependencies

```bash
composer update
```

Change the .env so that the database is connected correctly and add the following

```bash
API_URL = 'https://swapi.dev/api/'
```

Migrate the databases and fill the user table

```bash
php artisan migrate:fresh
php artisan db:seed
```

## Usage

Serve the project or make an alias

```bash
php artisan serve
```

Go to your localhost Laraval installation in your webbrowser and Login with the following credentials

```bash
Username: Luke
Password: demo
```

After logging in, fill the databases with the following buttons:

```bash
Update Species
Update Planets
Update People
```
After updating the database, go to the overview page trough the given link

