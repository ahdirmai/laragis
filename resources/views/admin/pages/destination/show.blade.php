@extends('layouts.admin.app')
@section('title','Detail '.$destination->name)


@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-7">
            <div class="card mb-3">
                <div class="card-header">Destination Detail</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $destination->name }}</h5>
                    <p class="card-text">
                        <span class="badge rounded-pill bg-primary">{{ $destination->category->name }}</span>
                        | ⭐ {{ $destination->rating }}
                    </p>
                    <p class="card-text">
                        {{ $destination->description }}
                    </p>
                    <div class="text-end">
                        <a href="javascript:void(0)" class="btn btn-primary">Edit</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5">

            <div class="card mb-3">
                <div class="card-header">Open Hours Detail</div>
                <div class="card-body">
                    <div class="row align-items-center text-center gap-3 d-flex">
                        @if (@$destination->destinationDetails->detail != null)

                        @foreach(@$destination->destinationDetails->detail as $key=>$value)
                        <div class="card col-md-5 align-middle align-self-center">
                            <div class="text-bold"> {{ Str::upper( $key)}}</div>
                            <div> {{ $value['open'] }} - {{ $value['close'] }}</div>
                        </div>
                        @endforeach

                        @else
                        <p>Empty</p>
                        @endif
                    </div>
                    <div class="text-end">
                        <button class="btn btn-primary"
                            data-url="{{ route('admin.destinations.open-hours.edit',$destination->slug) }}"
                            data-bs-toggle="modal" data-bs-target=".modal-basic"
                            data-title="Edit Destination Details">Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">Address Detail</div>
        <div class="card-body">
            @include('admin.pages.destination.edit-position')
            <h5 class="card-title mt-3">{{ $destination->address }}</h5>
            <div id="map" class="mb-2"></div>
            <div class="text-end">
                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" id="editPositionButton"
                    data-bs-target="#editPosition" aria-expanded="false" aria-controls="collapseExample">Edit</button>

            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">Galery</div>
        <div class="card-body">

            @include('admin.pages.destination.add-image')
        </div>
        <div class="text-end me-3">
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" id="addImageButton"
                data-bs-target="#addImage" aria-expanded="false" aria-controls="collapseExample">Tambah Foto</button>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <div id="carouselExample" class="carousel slide w-50 h-25" data-bs-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach ($destination->image as $item)
                        <li data-bs-target="#carouselExample" data-bs-slide-to="{{ $loop->iteration-1 }}"
                            class="{{ ($loop->iteration == 1)? " active" : "" }}"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach ($destination->image as $item)
                        <div class="carousel-item  {{ ($loop->iteration == 1)? " active" : "" }}">
                            <img class="d-block w-100" src="{{ $item->getUrl() }}" alt="First slide" />

                        </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

<style>
    #map {
        height: 400px;
    }
</style>
@endpush

@push('modals-section')
<x-admin.basic-modal />
@endpush

@push('scripts')
<script>
    $(document).ready(function(){
        $('#addImageButton').click(function(){
            $('#addImageButton').hide();
        })
        $('#canceAddImageButton').click(function(){
            $('#addImageButton').show();
        })

        $('#editPositionButton').click(function(){
            $('#editPositionButton').hide();
            $('#latitude').val('{{$destination->latitude}}')
            $('#longitude').val('{{$destination->longitude}}')

        })

        $('#cancelEditPositionButton').click(function(){
            $('#editPositionButton').show();
        })
    })
</script>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    var lat = {{$destination->latitude}};
    var long = {{$destination->longitude}};
    var zoom = 15;
    var map = L.map('map').setView([lat, long], zoom);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    setTimeout(function() {
            map.invalidateSize();
        }, 100);

        var marker = L.marker({
        lat:{{ $destination->latitude }},
        lon:{{ $destination->longitude }}
    }).addTo(map)
</script>

@stack('scripts-specials')
@endpush

@endsection