<div class="modal fade modal-basic" id="basicModal" tabindex="-1" aria-hidden="true">
    <div {{ $attributes->merge(['class' => 'modal-dialog']) }} role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-basic-title" id="exampleModalLabel1"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-basic-body">
                <div class="modal-body-custome">
                    <div class="text-center m-auto p-4">
                        <div class="spinner-border spinner-border-lg text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>