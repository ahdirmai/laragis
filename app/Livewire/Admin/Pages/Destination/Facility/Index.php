<?php

namespace App\Livewire\Admin\Pages\Destination\Facility;

use Livewire\Component;

class Index extends Component
{
    #facilityStored

    protected $listeners = [
        'facilityStored' => 'handleFacilityStored',
        'storeFacility' => 'handleStoreFacility'
    ];
    public $destination;
    public $slug;

    public $destinationFacilities;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->destination = \App\Models\Destination::where('slug', $this->slug)->first();
        $this->destinationFacilities = $this->destination->facilities;
    }

    public function render()
    {
        return view('livewire.admin.pages.destination.facility.index');
    }



    public function handleFacilityStored($message)
    {
        $this->destinationFacilities = $this->destination->facilities;
        session()->flash('success', $message);
    }
}
