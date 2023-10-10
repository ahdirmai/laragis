<div>
    <div class="card mb-4">
        <livewire:admin.pages.facility.form />
    </div>

    <div class="card">
        <h5 class="card-header pb-0">Facility Table</h5>
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
        <div class="table-responsive p-2 text-wrap">
            <table class="table p-1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>

                    <tr class="my-auto">
                        @foreach ($facilities as $facility)

                        <td class=" align-middle"><i class="fab fa-angular fa-lg text-danger me-3"></i>
                            <strong>{{ $loop->iteration }}</strong>
                        </td>
                        <td class=" align-middle">{{ $facility->name }}</td>
                        <td>{{ $facility->description }}</td>
                        <td class="align-middle">
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <button class="dropdown-item" data-bs-toggle="collapse"
                                        data-bs-target="#collapseExample" aria-expanded="false"
                                        aria-controls="collapseExample" wire:click='openEdit({{ $facility->id }})'><i
                                            class="bx bx-edit-alt me-1"></i>
                                        Edit</button>
                                    <a class="dropdown-item" wire:click='destroy({{ $facility->id }})'><i
                                            class="bx bx-trash me-1"></i>
                                        Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </thead>
            </table>
        </div>
    </div>

</div>