# Kz Laravel API Template

## Requirement

PHP: 8.2
Laravel: 10.9.0

## Features

- Authentication
- CRUD User
- Import CSV
- Export CSV
- Testing
- Code formatting
- Code linter
- Api Docs
- CI

## Getting Started

```bash
docker run --rm -v $(pwd):/app -w /app composer composer install
cp .env.example .env

./vendor/bin/sail up

./vendor/bin/sail artisan key:generate

./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed
```

## Check result

Open browser at http://localhost:80

### Api Docs
Open browser at http://localhost:80/api/docs

### Testing

```bash
# replace DB_DATABASE=testing and  run migrate
./vendor/bin/sail artisan migrate
# rollback DB_DATABASE
./vendor/bin/sail artisan test
```
