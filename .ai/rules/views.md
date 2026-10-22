---
paths:
  - 'storage/framework/views/livewire/views/*.blade.php'
---

# Views

## Clear Livewire view cache after changes
Livewire views are compiled to storage/framework/views. Force view cache rebuild by running php artisan view:clear after any Blade template changes in the `resources/views` or `livewire` directories.
