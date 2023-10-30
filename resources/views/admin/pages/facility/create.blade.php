<div class="p-4 pb-2">
    <form method="POST" action="{{ $url }}">
        @csrf
        <div class="mt-2">
            <label class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" />

            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mt-2">
            <label class="form-label">Description</label>
            <input type="text" class="form-control @error('desccription') is-invalid @enderror" name="description" />
            @error('description')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="text-end mt-4">
            <button class="btn btn-primary mb-3">Add Facility</button>
            <button class="btn btn-secondary mb-3" type="button" data-bs-dismiss="modal">Cancel</button>
        </div>
    </form>
</div>