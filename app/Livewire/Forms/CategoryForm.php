<?php

namespace App\Livewire\Forms;

use App\Concerns\Custom\CategoryValidationRules;
use App\Models\Category;
use Livewire\Attributes\Locked;
use Livewire\Form;
use LogicException;

class CategoryForm extends Form
{
    use CategoryValidationRules;

    #[Locked]
    public ?Category $category = null;

    public string $name = '';

    public string $code = '';

    protected function rules(): array
    {
        return $this->categoryRules($this->category);
    }

    protected function messages(): array
    {
        return $this->categoryFormErrorMessage();
    }

    public function store(): Category
    {
        $this->validate();

        $category = Category::create([
            'name' => $this->name,
            'code' => $this->code,
        ]);

        $this->reset();

        return $category;
    }

    public function setCategory(Category $category): void
    {
        $this->category = $category;
        $this->name = $category->name;
        $this->code = $category->code;
    }

    public function update(): Category
    {
        $category = $this->category;

        if ($category === null) {
            throw new LogicException('A category must be set before it can be updated.');
        }

        $this->validate();

        $category->update([
            'name' => $this->name,
            'code' => $this->code,
        ]);

        $this->reset();

        return $category;
    }
}
