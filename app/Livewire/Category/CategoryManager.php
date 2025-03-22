<?php

namespace App\Livewire\Category;

use Mary\Traits\Toast;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\On;

class CategoryManager extends Component
{
    use Toast;

    public $categories, $name, $description, $category_id;
    public $isModalOpen = 0;

    public function render()
    {
        $this->categories = Category::orderBy('id', 'desc')->get();
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

    #[On('closeModal')]
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

        $this->success($this->category_id ? 'Berhasil memperbarui data kategori.' : 'Berhasil membuat data kategori.', css: 'bg-neutral text-base-100 rounded-md');

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
         $this->success('Berhasil menghapus data kategori.', css: 'bg-neutral text-base-100 rounded-md');
    }
}
