<div class="card mb-3">
    <div class="card-header">Facillies</div>

    <div class="card-body">
        <livewire:admin.pages.destination.facility.form :slug='$slug'>
    </div>
    <div class="text-end me-3">
        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" id="addFacillitiesButton"
            data-bs-target="#addFacillities" aria-expanded="false" aria-controls="collapseExample">Add
            Facilities</button>
    </div>

    <div class="p-2">
        @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
        @endif

        @if(session()->has('error'))
        <div class="alert alert-danger" role="alert">
            {{ session()->get('error') }}
        </div>
        @endif
    </div>
    <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Facility Name</th>
                        <th>Status</th>
                        <th>Qty</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($destinationFacilities as $destinationFacility)

                    <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $destinationFacility->name
                                }}</strong></td>
                        <td>
                            <span class="badge bg-label-primary me-1">{{ $destinationFacility->pivot->status }}</span>
                        </td>
                        <td>{{ $destinationFacility->pivot->quantity }}</td>
                        <td>{{ $destinationFacility->pivot->description }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                            class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i>
                                        Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
</div>