<?php

namespace App\Livewire\Category;

use Livewire\Component;
use App\Models\Category;

class CategoryManager extends Component
{
    public $categories, $name, $description, $category_id;
    public $isModalOpen = 0;

    public function render()
    {
        $this->categories = Category::all();
        return view('livewire.category.index');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->description = '';
        $this->category_id = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Category::updateOrCreate(['id' => $this->category_id], [
            'name' => $this->name,
            'description' => $this->description
        ]);

        session()->flash('message', $this->category_id ? 'Category updated successfully.' : 'Category created successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->category_id = $id;
        $this->name = $category->name;
        $this->description = $category->description;

        $this->openModal();
    }

    public function delete($id)
    {
        Category::find($id)->delete();
        session()->flash('message', 'Category deleted successfully.');
    }
}
