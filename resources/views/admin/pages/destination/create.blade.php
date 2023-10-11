@extends('layouts.admin.app')
@section('title','Create Destinations')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Create Destinations</h5>
        </div>
        <div class="card-body">
            <form>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="address" />
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-5">
                        <select class="form-select" id="provinceSelect" aria-label="Default select example">
                            <option selected value="0" value="0">Pilih Provinsi</option>
                            @foreach ($provinces as $province)
                            <option value={{ $province->code}}>{{ $province->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class=" col-sm-5">
                        <select class="form-select" id="citySelect" aria-label="Default select example" disabled>
                            <option value="0" selected>Pilih Kota</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-4">
                        <select class="form-select" id="districtSelect" aria-label="Default select example" disabled>
                            <option value="0" selected>Pilih Kelurahan</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <select class="form-select" id="villageSelect" name="villageSelect"
                            aria-label="Default select example" disabled>
                            <option value="0" selected>Pilih Desa/Kecamatan</option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" placeholder="Postal Code" id="postsalCode"
                            name="postsalCode" />
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="category" name="category" aria-label="Default select example">
                            <option selected value="0">Pilih Category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Location</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="latitude" placeholder="latitude" />
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="longitude" placeholder="longitude" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <div id="map"></div>
                    </div>
                </div>

                <div class="row justify-content-end">
                    <div class="col-sm-10 text-end">
                        <a type="submit" href="{{ route('admin.destinations.index') }}"
                            class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </form>
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

@push('scripts')
{{-- Address Script --}}
<script>
    let lat = -2.548926 ,long=118.0148634,zoom=5;
    const citySelect = $('#citySelect');
    const districtSelect = $('#districtSelect');
    const villageSelect = $('#villageSelect');


    $('#provinceSelect').on('change', function() {
        const value = $(this).val();
        if (value === "0") {
                citySelect.prop('disabled', true);
                citySelect.empty().append('<option selected value="0">Pilih Kota</option>');
                districtSelect.empty().append('<option selected value="0">Pilih Kota</option>');
                districtSelect.prop('disabled', true);
                villageSelect.empty().append('<option selected value="0">Pilih Kota</option>');
                villageSelect.prop('disabled', true);
                return
        }
        const url = `{{ route('address.city') }}/${value}`;
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                citySelect.prop('disabled', false);
                citySelect.empty().append('<option selected value="0">Pilih Kota</option>');
                districtSelect.empty().append('<option selected value="0">Pilih Kelurahan</option>');
                districtSelect.prop('disabled', true);
                villageSelect.empty().append('<option selected value="0">Pilih Desa/Kecamatan</option>');
                villageSelect.prop('disabled', true);
                // Tambahkan opsi dari data yang diterima
                if (response.status === "success") {
                    const cities = response.data; // Ambil array data
                    cities.forEach(function(city) {
                        // Tambahkan opsi-opsi ke elemen select
                        citySelect.append(new Option(city.name, city.code));
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('Kesalahan:', error);
            }
        });
    });

    $('#citySelect').on('change', function() {
        const value = $(this).val();
        const url = `{{ route('address.district') }}/${value}`;
        if (value === "0") {

                districtSelect.empty().append('<option selected value="0" >Pilih Kelurahan</option>');
                districtSelect.prop('disabled', true);
                villageSelect.empty().append('<option selected value="0">Pilih Desa/Kecamatan</option>');
                villageSelect.prop('disabled', true);
                return
        }
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                districtSelect.prop('disabled', false);
                districtSelect.empty().append('<option selected value="0">Pilih Kelurahan</option>');
                villageSelect.empty().append('<option selected value="0">Pilih Desa/Kecamatan</option>');
                villageSelect.prop('disabled', true);

                // Tambahkan opsi dari data yang diterima
                if (response.status === "success") {
                    const districts = response.data; // Ambil array data
                    districts.forEach(function(district) {
                        // Tambahkan opsi-opsi ke elemen select
                        districtSelect.append(new Option(district.name, district.code));
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('Kesalahan:', error);
            }
        });
    });

    $('#districtSelect').on('change', function() {
        const value = $(this).val();
        if (value === "0") {
            villageSelect.empty().append('<option selected value="0">Pilih Desa/Kecamatan</option>');
            villageSelect.prop('disabled', true);
            return
        }
        const url = `{{ route('address.village') }}/${value}`;
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                villageSelect.prop('disabled', false);
                villageSelect.empty().append('<option selected value="0">Pilih Desa/Kecamatan</option>');

                if (response.status === "success") {
                    const villages = response.data; // Ambil array data
                    villages.forEach(function(village) {
                        // Tambahkan opsi-opsi ke elemen select
                        villageSelect.append(new Option(village.name, village.code));
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('Kesalahan:', error);
            }
        });
    });

    $('#villageSelect').on('change', function() {
        const value = $(this).val();
        const url = `{{ route('address.village-detail') }}/${value}`;
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                const village = response.data;
                console.log(village.meta);
                if (village.meta.pos !== "NULL") {
                    const postsal = $('#postsalCode').val(village.meta.pos);

                }

                if (village.meta.lat !== "NULL" && village.meta.long !== "NULL") {
                console.log('masuk');

                    lat = village.meta.lat;
                    long = village.meta.long;
                    map.setZoom(13)
                    map.setView([lat, long]);

                }
            },
            error: function(xhr, status, error) {
                console.error('Kesalahan:', error);
            }
        });
    });

</script>
{{-- End Address Script--}}


{{-- Map Script --}}
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    var map = L.map('map').setView([lat, long], zoom);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);


    var marker ;
    function onMapClick(e) {
        if (marker) {
            map.removeLayer(marker)
        }
        console.log(lat,long,zoom);
        const latitude = $('input[name="latitude"]').val(e.latlng.lat);
        const longitude = $('input[name="longitude"]').val(e.latlng.lng);
        marker=L.marker(e.latlng).addTo(map);
    }

     map.on('click', onMapClick);
</script>
@endpush


@endsection