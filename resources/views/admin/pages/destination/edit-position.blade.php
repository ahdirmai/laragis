<div class="collapse" id="editPosition">
    <form action="{{ route('admin.destinations.position.edit',$destination->slug) }}" enctype="multipart/form-data"
        method="POST">
        @csrf
        @method('PUT')
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Location</label>
            <div class="col-sm-5">
                <input type="text" value="{{ old('latitude') }}"
                    class="form-control @error('latitude') is-invalid @enderror" name="latitude" placeholder="latitude"
                    id="latitude" />
            </div>
            <div class="col-sm-5">
                <input type="text" value="{{ old('longitude') }}"
                    class="form-control @error('longitude') is-invalid @enderror" name="longitude"
                    placeholder="longitude" id="longitude" />
            </div>
            @error('latitude' ||'longitude')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="text-end mb-3 mt-2">
            <button class="btn btn-primary" type="submit">Save</button>
            <button class="btn btn-secondary" type="button" id="cancelEditPositionButton" data-bs-toggle="collapse"
                data-bs-target="#editPosition" aria-expanded="false" aria-controls="collapseExample">Cancel</button>
        </div>
    </form>
</div>

@push('scripts-specials')
<script>
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