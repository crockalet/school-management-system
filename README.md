# School Management System

This is a simple Laravel application. The default database is set to **MariaDB**.

## Setup Instructions

1. **Install dependencies**

```bash
composer install
```

2. **Copy and configure environment file**

```bash
cp .env.example .env
```

Edit `.env` and set your credentials.

1. **Generate application key**

```bash
php artisan key:generate
```

4. **Run migrations**

```bash
php artisan migrate
```

5. **Start the development server**

```bash
php artisan serve
```

Your Laravel application should now be running.

## API Documentation

If the server is running, API documentation can be accessed locally at `<APP_URL>/docs/api`, otherwise for API reference see [API_DOCS.md](./API_DOCS.md).
