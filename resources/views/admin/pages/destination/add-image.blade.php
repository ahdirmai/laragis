<div class="collapse" id="addImage">
    <form action="{{ route('admin.destinations.gallery.store',$destination->slug) }}" enctype="multipart/form-data"
        method="POST">
        @csrf
        <div class="d-flex flex-col">
            <div>
                <input type="file" id="imageInput" class="form-control" name="attachment[]" multiple>
            </div>
        </div>
        <div class="d-flex gap-3 mt-2" id="imagePreview">
        </div>

        <div class="text-end mb-3 mt-2">
            <button class="btn btn-primary" type="submit">Save</button>
            <button class="btn btn-secondary" type="button" id="cancelAddImageButton" data-bs-toggle="collapse"
                data-bs-target="#addImage" aria-expanded="false" aria-controls="collapseExample"
                onclick="resetPreview()">Cancel</button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
      // Tangani perubahan dalam input file
      $('#imageInput').change(function() {
        var imagePreview = $('#imagePreview');

        // Hapus semua pratinjau gambar yang ada
        imagePreview.empty();

        // Loop melalui setiap file yang dipilih
        for (var i = 0; i < this.files.length; i++) {
          var file = this.files[i];

          // Periksa apakah file adalah gambar
          if (file.type.match('image.*')) {
            // Buat objek URL untuk file gambar
            var imageUrl = URL.createObjectURL(file);

            // Tampilkan pratinjau gambar
            var imageElement = $('<img>').attr('src', imageUrl).attr('class', 'img-thumbnail object-fit-none').attr('style', 'height: 150px; width: auto;');
            imagePreview.append(imageElement);
          }
        }
      });
    });
</script>

@endpush