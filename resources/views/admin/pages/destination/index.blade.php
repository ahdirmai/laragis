@extends('layouts.admin.app')
@section('title','Destinations')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <h5 class="card-header pb-0">Destinations Table</h5>

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

        <div class="text-end me-3">
            <a class="btn btn-primary" href="{{ route('admin.destinations.create') }}">Create Destination</a>
        </div>
        <div class="table-responsive p-2 text-wrap">
            <table class="table p-1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Category</th>
                        <th>Thumbnail</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($destinations as $destination)

                    <tr class="my-auto">
                        <td class=" align-middle"><i class="fab fa-angular fa-lg text-danger me-3"></i>
                            <strong>{{ $loop->iteration }}</strong>
                        </td>
                        <td class=" align-middle">{{ $destination->name }}</td>
                        <td class=" align-middle">{{ $destination->address }}</td>
                        <td class=" align-middle">{{ $destination->category }}</td>
                        <td class=" align-middle">
                            <img src="{{ $destination->thumbnail }}" alt="" class="img-thumbnail">
                        </td>
                        <td class="align-middle">@if ($destination->status)
                            <span class="badge bg-success">Open</span>
                            @else
                            <span class="badge bg-danger">Close</span>
                            @endif
                        </td>
                        <td class="align-middle">
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item"></i>
                                        Detail</a>
                                    <a class="dropdown-item"></i>
                                        Edit</a>
                                    <a class="dropdown-item"></i>
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
@endsection