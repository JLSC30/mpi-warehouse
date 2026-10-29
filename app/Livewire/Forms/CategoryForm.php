<?php

namespace App\Livewire\Forms;

use App\Concerns\Custom\CategoryValidationRules;
use App\Livewire\Forms\Concerns\RejectTrashedValue;
use App\Models\Category;
use Illuminate\Contracts\Validation\ValidationRule;
use Livewire\Attributes\Locked;
use Livewire\Form;
use LogicException;

class CategoryForm extends Form
{
    use CategoryValidationRules, RejectTrashedValue;

    #[Locked]
    public ?Category $category = null;

    public string $name = '';

    public string $code = '';

    /**
     * @return array<string, array<int, ValidationRule|array<mixed>|string>>
     */
    protected function rules(): array
    {
        return $this->categoryRules($this->category);
    }

    /**
     * @return array<string, string>
     */
    protected function messages(): array
    {
        return $this->categoryFormErrorMessage();
    }

    public function store(): Category
    {
        $this->validate();

        $this->rejectTrashedValue(Category::class, 'code', $this->code, 'category');

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

        $this->rejectTrashedValue(Category::class, 'code', $this->code, 'category');

        $category->update([
            'name' => $this->name,
            'code' => $this->code,
        ]);

        $this->reset();

        return $category;
    }
}
