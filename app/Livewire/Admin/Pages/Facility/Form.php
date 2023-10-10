<?php

namespace App\Livewire\Admin\Pages\Facility;

use App\Models\Facility;
use Livewire\Component;

class Form extends Component
{
    public $name, $description, $facilityId, $createMode = true, $updateMode = false;
    public $listeners = [
        'openEditFacility' => 'handleOpenEdit'
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


    public function handleOpenEdit($facility)
    {
        $this->createMode = false;
        $this->updateMode = true;
        $this->name = $facility['name'];
        $this->facilityId = $facility['id'];
        $this->description = $facility['description'];
    }

    public function render()
    {
        return view('livewire.admin.pages.facility.form');
    }

    public function save()
    {
        $this->validate();
        try {
            Facility::create([
                'name' => $this->name,
                'slug' => \Str::slug($this->name),
                'description' => $this->description

            ]);

            $this->resetFields();
            $message = 'Facility Created Successfully!!';
            $this->dispatch('storeFacility', $message);
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
    }

    public function update()
    {
        $this->validate();
        try {
            $Facility = Facility::find($this->facilityId);
            $Facility->update([
                'name' => $this->name,
                'description' => $this->description
            ]);

            $message = 'Facility Updated Successfully!!';
            $this->resetFields();
            $this->dispatch('storeFacility', $message);
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
    }
}
