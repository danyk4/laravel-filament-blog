# Laravel 12 Blog with Filament Admin Panel

Laravel 12 simple blog with FilamentPHP admin panel.

#### 1. Clone the project

```bash
git clone https://github.com/danyk4/laravel-filament-blog
```

#### 2. Run `composer and npm install`

```bash
composer install
npm install && npm run build
```

#### 3. Copy `.env.example` into `.env`

```bash
cp .env.example .env
```

and add your MySql data

#### 4. Set encryption key

```bash
php artisan key:generate --ansi
```

#### 5. Run migrations

```bash
php artisan migrate
```

#### 6. Add Filament Admin user

```bash
php artisan make:filament-user
```

#### 7. Add link to public storage

```bash
php artisan storage:link
```

#### 8. On localhost run server

```bash
composer run dev
```
