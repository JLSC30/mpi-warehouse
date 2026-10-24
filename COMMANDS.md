# Command Reference

## Add `is_admin` to `users`

```bash
php artisan make:migration add_is_admin_to_users_table --table=users --no-interaction
```

Generated migration: `database/migrations/2026_10_18_230449_add_is_admin_to_users_table.php`

## Apply the migration and seed users

```bash
php artisan migrate --no-interaction
php artisan db:seed --no-interaction
```

## Generate Category model, migration, and factory

```bash
php artisan make:model Category --migration --factory --no-interaction
```

## Apply Category migration and seed ten categories

```bash
php artisan migrate --no-interaction
php artisan db:seed --no-interaction
```

## Fix Categories page server error and verify

```bash
php artisan view:clear
php artisan test --filter=Category --compact
```

Root cause: a blank `:href=""` on the Export CSV button caused Laravel to call `e()` without arguments during Blade compilation.

## Convert Categories table to a list and verify

```bash
php artisan view:clear
php artisan test --filter=Category --compact
```

## Refresh Categories list styling

```bash
php artisan view:clear
```

## Apply DaisyUI-inspired Tailwind list styling

```bash
php artisan view:clear
```

## Render category names and codes in the list

```bash
php artisan view:clear
```

## Add disabled category edit and delete buttons

```bash
php artisan view:clear
```

## Improve Categories mobile actions and pagination

```bash
php artisan view:clear
```

## Fix category total count and verify mobile pagination

```bash
php artisan make:test --pest CategoryListTest --no-interaction
php artisan view:clear
php artisan test tests/Feature/CategoryListTest.php --compact
```

## Verify category total-count fix

```bash
php artisan view:clear
php artisan test tests/Feature/CategoryListTest.php --compact
```