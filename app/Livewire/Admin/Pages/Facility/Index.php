<?php

namespace App\Livewire\Admin\Pages\Facility;

use App\Models\Facility;
use Livewire\Component;

class Index extends Component
{
    public $listeners = [
        'storeFacility' => 'handleStoreFacility'
    ];
    public function render()
    {
        $facilities = \App\Models\Facility::all();
        return view('livewire.admin.pages.facility.index', compact('facilities'));
    }

    public function openEdit($id)
    {
        $facility = Facility::find($id);
        $this->dispatch('openEditFacility', $facility);
    }

    public function handleStorefacility($message)
    {
        $this->dispatch('refresh');
        session()->flash('success', $message);
    }

    public function destroy($id)
    {
        $facility = Facility::find($id);
        $facility->delete();
        $this->dispatch('refresh');
        session()->flash('success', 'Facility Deleted Successfully!!');
    }
}
