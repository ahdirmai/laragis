<?php

namespace App\Livewire\Admin\Pages\Destination\Facility;

use App\Models\Destination;
use App\Models\DestinationHasFacility;
use App\Models\Facility;
use Livewire\Component;

class Form extends Component
{
    public $slug;
    public $facilities;
    public $facility_id;
    public $facility_status;
    public $facility_qty;
    public $facility_description;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $destination = Destination::where('slug', $this->slug)->first();
        $destinationFacilities_id = DestinationHasFacility::where('destination_id', $destination->id)->get()->pluck('facility_id');
        $this->facilities = Facility::WhereNotIn('id', $destinationFacilities_id)->get();

        // $data = [
        //     'destination' => $destination,
        //     'destinationFacilities_id' => $destinationFacilities_id
        // ];
        return view('livewire.admin.pages.destination.facility.form');
    }

    public function storeFacility()
    {
        $this->validate([
            'facility_id' => 'required',
            'facility_status' => 'required',
            'facility_qty' => 'required',
            'facility_description' => 'required',
        ]);

        $destination = \App\Models\Destination::where('slug', $this->slug)->first();

        $destination->facilities()->attach($this->facility_id, [
            'status' => $this->facility_status,
            'quantity' => $this->facility_qty,
            'description' => $this->facility_description,
        ]);

        $this->reset('facility_id', 'facility_status', 'facility_qty', 'facility_description');

        $message = 'Facility Add Successfully!!';
        $this->dispatch('facilityStored', $message);
    }
}
