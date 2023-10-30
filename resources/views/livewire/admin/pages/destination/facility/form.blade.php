<div class="collapse" id="addFacillities">
    {{-- {{ $destinationFacilities_id }} --}}
    <form enctype="multipart/form-data" wire:submit.prevent='storeFacility'>
        <div class="row mb-3">
            <!-- Open Day Type -->
            <label class="col-sm-3 col-form-label">Facility Name</label>
            <div class="col-sm-9">
                <select class="form-select @error('facility') is-invalid @enderror" wire:model='facility_id'
                    id="facility" aria-label="Default select example">
                    <option selected hidden>Pilih Fasilitas</option>
                    @forelse ($facilities as $facility)
                    <option value="{{ $facility->id }}">{{ $facility->name }}
                    </option>
                    @empty
                    <option value="addFacility"> + Add Facility</option>
                    @endforelse

                </select>

                <button type="button" data-url="{{ route('admin.facilities.create') }}" id="addFacilityButton"
                    data-bs-toggle="modal" data-bs-target=".modal-basic" data-title="Add Facility" hidden></button>
            </div>
        </div>
        <div class="row mb-3">
            <!-- Open Day Type -->
            <label class="col-sm-3 col-form-label">Status</label>
            <div class="col-sm-9">
                <select class="form-select @error('facility_status') is-invalid @enderror" wire:model='facility_status'
                    id="facility_status" aria-label="Default select example">
                    <option selected hidden>Pilih Status</option>
                    @php
                    $facilityStatus = ['good','broke','on-fixing']
                    @endphp

                    @foreach ($facilityStatus as $status)
                    <option value="{{ $status}}"> {{ ucfirst($status) }}
                    </option>
                    @endforeach
                </select>
            </div>


        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Qty</label>
            <div class="col-sm-9">
                <input type="text" class="form-control @error('facility_qty') is-invalid @enderror"
                    wire:model='facility_qty' />
            </div>

        </div>

        <div class="row mb-3">

            <label class="col-sm-3 col-form-label">Desctiption</label>
            <div class="col-sm-9">
                <input type="text" class="form-control @error('facility_description') is-invalid @enderror"
                    wire:model='facility_description' />
            </div>
        </div>
        <div class="text-end mb-3 mt-2">
            <button class="btn btn-primary" type="submit">Add</button>
            <button class="btn btn-secondary" type="button" id="cancelAddFacillitiesButton" data-bs-toggle="collapse"
                data-bs-target="#addFacillities" aria-expanded="false" aria-controls="collapseExample"
                onclick="resetPreview()">Cancel</button>
        </div>
    </form>
    @push('scripts')
    <script>
        // get selectoption dengan id facility
        $('#facility').on('change',function(e){
            var valueSelected = this.value;
            if (valueSelected=="addFacility") {
                $("#addFacilityButton").click();
            }
        })

        // reset modal if cancel/closed
        $('.modal-basic').on('hide.bs.modal',(event) =>{
                // console.log(button);
                // console.log('closed');
                var modalTrigger = $('#facility').val('');
            });

    </script>

    @endpush

    @push('modal-section')
    <x-admin.basic-modal></x-admin.basic-modal>
    @endpush
</div>