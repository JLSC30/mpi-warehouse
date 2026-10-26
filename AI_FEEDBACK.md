# Project Review — MPI Warehouse

**Timestamp:** 2026-10-25 15:20:40 -05:00  
**Subject:** Full project review — UI/UX, security, DX, testing, and CI  
**Scope:** Source, routes, Livewire category/location flows, tests, CI, and the shared Categories page. Review only; application code was not changed.

## Findings

### High — Supplier navigation is a duplicate Locations menu

`resources/views/layouts/app/sidebar.blade.php` labels a section “Supplier” but gates it with the Location policy and links both entries to `locations.index` / `locations.trash`. The rendered sidebar exposes a feature that does not exist and takes users to the wrong data. Remove the placeholder until Suppliers are implemented, or wire it to its own model, routes, policy, and tests.

### High — Seeding can create an administrator with a known password

`database/seeders/DatabaseSeeder.php` creates and verifies `admin@warehouse.test`, then grants it admin privileges. The factory password is the literal `password`; `db:seed` has no environment guard. The README warning is not protection against accidentally seeding a fresh production database. Keep demo accounts in an explicitly local-only seeder and provision production administrators through a secure, deliberate process.

### Medium — Re-running the seeder silently multiplies sample data

Every `db:seed` run creates 20 new categories and 10 new locations. Make sample data idempotent with stable identifiers/upserts, or separate demo data from the normal seeding path, so reruns do not inflate a database.

### Medium — The advertised CI check currently fails

`composer ci:check` stops at Pint because `test_redis.php` violates the configured style rules. This standalone script is also outside the Pest suite, so it is not providing repeatable CI coverage. Either convert the Redis behavior into an intentional integration test, or remove the scratch script from the CI lint surface and document how Redis checks are run.

### Medium — Generated Blade caches are tracked

Git tracks 219 files under `storage/framework/views/`; the current worktree already shows generated cache files modified and deleted. These compiled files are runtime artifacts, not reviewable source. Ignore and untrack them so normal requests and tests do not create noisy diffs or preserve stale compiled templates.

### Medium — Five rows per page makes the catalog unnecessarily click-heavy

The Categories page shows 20 records as four pages, with only five entries per page; Locations uses the same limit. For routine warehouse work, default to a more useful page size (for example 25) and consider a small page-size selector if dataset sizes vary.

## What is working well

- Category and Location CRUD have explicit validation, policy checks, soft-delete flows, and corresponding feature tests.
- Admin-only routes and Livewire write actions are both protected; the tests exercise regular-user denials as well as admin access.
- The visual hierarchy on the shared Categories page is clear, and the list/search/actions/pagination are easy to scan.

## Verification

- `php artisan test --compact`: **84 passed**, 268 assertions.
- `composer types:check`: **passed**, no errors.
- `npm run build`: **passed**; Vite reports an optional `fontaine` optimization warning.
- `composer ci:check`: **failed at Pint** on `test_redis.php` before reaching its later checks.
