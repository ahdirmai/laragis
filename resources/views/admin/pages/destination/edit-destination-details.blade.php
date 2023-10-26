<form action="{{ $url }}" class="p-4" method="POSt">
    @csrf
    @method('PUT')


    <div class="text-end">
        <button type="button" class="btn btn-secondary me-1" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" id="submitButton" class="btn btn-primary">Create</button>
    </div>
</form>