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

Optionally seed the database with local sample users and categories:

```bash
php artisan db:seed
```

On a fresh database, the seeder creates these sample accounts:

| Role | Email | Password |
| --- | --- | --- |
| Administrator | `admin@warehouse.test` | `password` |
| Standard user | `user@warehouse.test` | `password` |

These are development-only credentials. Do not use them in a deployed or publicly accessible environment.

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
| `php artisan db:seed` | Add the local sample users and categories |

## Authorization

Category pages and actions are restricted to users whose `is_admin` flag is enabled. The database seeder creates a local administrator for development. For other environments, assign administrator access through your established account-provisioning process; do not expose sample credentials or grant admin access to untrusted users.

## Technology

- Laravel 13
- Livewire 4 with Volt-style single-file components
- Flux UI
- Tailwind CSS 4 and Vite
- SQLite by default
- Pest for automated tests
