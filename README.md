# MPI Warehouse

MPI Warehouse is a Laravel application for managing warehouse reference data. The current application includes an administrator-only category catalog with search, editing, and soft-delete recovery.

## Features

- Category listing with name/code search and pagination
- Create and edit categories with unique codes and input validation
- Soft-delete categories, then restore or permanently delete them from the trash
- Administrator-only category access
- Authentication with password reset, two-factor authentication, and passkey support

## Requirements

- PHP 8.3 or newer
- Composer
- Node.js and npm

## Local setup

From the project directory, run:

```bash
composer run setup
```

The setup script installs PHP and JavaScript dependencies, creates `.env` from `.env.example` when needed, generates the application key, runs database migrations, and builds the frontend assets. The default environment uses SQLite.

Optionally seed a fresh local database with demo users and warehouse data. In PowerShell, from the project directory, run:

```powershell
$env:APP_ENV = 'local'
php artisan db:seed
```

The command runs `DatabaseSeeder`, which calls `LocalDemoSeeder`. The demo seeder creates sample users, categories, locations, and suppliers, and refuses to run unless `APP_ENV=local`. The environment setting above applies to the current PowerShell session. If your `.env` already sets `APP_ENV=local`, you can run `php artisan db:seed` directly.

Run this once on a fresh local database. Each run adds more sample categories, locations, and suppliers. The demo accounts are created only if they do not already exist, so rerunning the seeder does not reset their passwords. On a fresh database, it creates these sample accounts:

| Role | Email | Password |
| --- | --- | --- |
| Administrator | `admin@warehouse.test` | `password` |
| Standard user | `user@warehouse.test` | `password` |

These are development-only credentials. Do not use them in a deployed or publicly accessible environment. Provision production administrators only through a separate, controlled account-provisioning process.

Start the development server, queue listener, and Vite server together:

```bash
composer run dev
```

Open [http://localhost:8000](http://localhost:8000). Register or sign in, then use the seeded administrator account to access the category pages.

## Useful commands

| Command | Purpose |
| --- | --- |
| `php artisan test` | Run the test suite |
| `composer test` | Run code-style checks, static analysis, and tests |
| `npm run build` | Build production frontend assets |
| `npm run dev` | Run only the Vite development server |
| `php artisan migrate` | Apply pending database migrations |
| `php artisan db:seed` | Add local-only sample users, categories, locations, and suppliers; blocked outside `APP_ENV=local` |

## Authorization

Category pages and actions are restricted to users whose `is_admin` flag is enabled. The [LocalDemoSeeder](database/seeders/LocalDemoSeeder.php) creates a local administrator for development and refuses to run outside `APP_ENV=local`. No production administrator is seeded; provision administrator access through a separate, controlled account-provisioning process.

## Technology

- Laravel 13
- Livewire 4 with Volt-style single-file components
- Flux UI
- Tailwind CSS 4 and Vite
- SQLite by default
- Pest for automated tests
