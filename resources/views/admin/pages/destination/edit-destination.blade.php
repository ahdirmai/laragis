<form action="{{ $url }}" class="p-4" method="POST">
    @csrf
    @method('PUT')
    {{-- {{ $url }} --}}



    <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
            <input type="text" value="{{ old('name',$destination->name) }}"
                class="form-control @error('name') is-invalid @enderror" name="name" />
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Description</label>
        <div class="col-sm-10">
            <textarea class="form-control @error('description') is-invalid @enderror"
                name="description"> {{ old('description', $destination->description) }}</textarea>
            @error('description')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Category</label>
        <div class="col-sm-10">
            <select class="form-select @error('category') is-invalid @enderror" id="category" name="category"
                aria-label="Default select example">
                <option selected value="0">Pilih Category</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $destination->category_id == $category->id? "selected":"" }}>{{
                    $category->name
                    }}</option>
                @endforeach
            </select>
            @error('category')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="text-end">
        <button type="button" class="btn btn-secondary me-1" data-bs-dismiss="modal">Cancel</button>
        @if ($condition = 'edit')
        <button type="submit" id="submitButton" class="btn btn-primary">Update</button>
        @else
        <button type="submit" id="submitButton" class="btn btn-primary">Create</button>
        @endif
    </div>
</form>