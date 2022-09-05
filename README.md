# Running the project

## clone the repo from github
```git clone https://github.com/Azer5C74/Lumen-JWT-Auth```

## make your .env file
```cp .env.example .env```

## install dependencies
```composer install```

## generate JWT secret
```php artisan jwt:secret```

## migrate the DB
```php artisan migrate```

## run the project
```php -S localhost:8000 -t public```
