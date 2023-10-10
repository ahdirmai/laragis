<?php

namespace App\Livewire\Admin\Pages\Category;

use App\Models\Category;
use Livewire\Component;

class Index extends Component
{
    public $listeners = [
        'storeCategory' => 'handleStoreCategory'
    ];

    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.pages.category.index', compact('categories'));
    }

    public function openEdit($id)
    {
        $category = Category::find($id);
        $this->dispatch('openEdit', $category);
    }

    public function handleStoreCategory($message)
    {
        $this->dispatch('refresh');
        session()->flash('success', $message);
    }
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        $this->dispatch('refresh');
        session()->flash('success', 'Category Deleted Successfully!!');
    }
}
