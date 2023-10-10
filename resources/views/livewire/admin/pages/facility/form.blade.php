<div class="p-4 pb-2">
    <form wire:submit.prevent>
        <div class="mt-2">
            <label class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model='name' />

            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mt-2">
            <label class="form-label">Description</label>
            <input type="text" class="form-control @error('desccription') is-invalid @enderror"
                wire:model='description' />
            @error('description')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        @if ($createMode)
        <div class="text-end mt-4">
            <button wire:click='save' class="btn btn-primary mb-3">Add Facility</button>
        </div>
        @endif

        @if ($updateMode)
        <div class="text-end mt-4">
            <button wire:click='update' class="btn btn-primary mb-3">Update Facility</button>

            <button wire:click='resetFields' class="btn btn-secondary mb-3">Cancel</button>
        </div>
        @endif
    </form>
</div>