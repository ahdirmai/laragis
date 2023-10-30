<div class="modal modal-delete" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{
                    $title ?? "" }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $body??"" }}
            </div>
            <form method="POST" id="deleteForm">
                @csrf
                @method('DELETE')

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('.modal-delete').on('show.bs.modal',(event) =>{
        var button = $(event.relatedTarget)
        var url = button.data('url')

        console.log(url);
        var modal = $(this)
        formDelete = $('#deleteForm');
        formDelete.attr('action',url);

        // modal.find('#deleteForm').attr("action",button.data('url'))
        // console.log('delete');
                // var title = button.data('title')
                // console.log(title);
                // modal.find('.modal-basic-title').text(title)
                // modal.find('.modal-body-custome').load(url)
    });
</script>