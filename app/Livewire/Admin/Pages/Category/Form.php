<?php

namespace App\Livewire\Admin\Pages\Category;

use App\Models\Category;
use Livewire\Component;

class Form extends Component
{

    public $name, $description, $categoryId, $createMode = true, $updateMode = false;
    public $listeners = [
        'openEdit' => 'handleOpenEdit'
    ];

    protected $rules = [
        'name' => 'required',
        'description' => 'required'
    ];

    public function resetFields()
    {
        $this->name = '';
        $this->description = '';
        $this->createMode = true;
        $this->updateMode = false;
    }


    public function handleOpenEdit($category)
    {
        $this->createMode = false;
        $this->updateMode = true;
        $this->name = $category['name'];
        $this->categoryId = $category['id'];
        $this->description = $category['description'];
    }

    public function render()
    {
        return view('livewire.admin.pages.category.form');
    }

    public function save()
    {
        $this->validate();
        try {
            Category::create([
                'name' => $this->name,
                'description' => $this->description
            ]);

            $message = 'Category Created Successfully!!';
            $this->resetFields();
            $this->dispatch('storeCategory', $message);
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
    }

    public function update()
    {
        $this->validate();
        try {
            $category = Category::find($this->categoryId);
            $category->update([
                'name' => $this->name,
                'description' => $this->description
            ]);

            $message = 'Category Updated Successfully!!';
            $this->resetFields();
            $this->dispatch('storeCategory', $message);
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
    }
}
