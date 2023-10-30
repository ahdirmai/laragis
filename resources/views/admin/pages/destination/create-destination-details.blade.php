<form action="{{ $url }}" class="p-4" method="POST">
    @csrf
    @if($condition == 'edit')
    @method('PUT')
    @endif
    <div class="row mb-3">
        <!-- Open Day Type -->
        <label class="col-sm-3 col-form-label">Open Day Type</label>
        <div class="col-sm-9">
            <select class="form-select @error('open_day_type') is-invalid @enderror" name="open_day_type"
                id="open_day_type" aria-label="Default select example">
                <option selected hidden>Pilih Hari Buka</option>
                <option value="everyday" {{ @$destinationDetails->open_day_type=="everyday"?"selected":"" }}>Everyday
                </option>
                <option value="custom" {{ @$destinationDetails->open_day_type=="custom"?"selected":"" }}>Custom
                </option>
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <!-- Open Time Type -->
        <label class="col-sm-3 col-form-label">Open Time Type</label>
        <div class="col-sm-9">
            <select class="form-select @error('open_time_type') is-invalid @enderror" name="open_time_type"
                id="open_time_type" aria-label="Default select example">
                <option selected hidden>Pilih Jam Buka</option>
                <option value="default" {{ @$destinationDetails->open_time_type=="default"?"selected":"" }}>Default
                    (08.00 - 17.00)</option>
                <option value="custom" {{ @$destinationDetails->open_time_type=="custom"?"selected":"" }}>Custom
                </option>
            </select>
        </div>
    </div>

    <div class="{{ $condition == 'edit'? "":" d-none" }}" id="details-form">
        <div class="divider">
            <div class="divider-text">Details</div>
        </div>
        <!-- Simplify day of the week input using a loop -->
        @php
        $daysOfWeek = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        @endphp
        @foreach ($daysOfWeek as $day)
        <div class="row mb-3">
            <div class="col-sm-1 d-flex align-items-center">
                <input class="form-check-input" type="checkbox" {{ @$destinationDetails->detail[$day]?"checked":"" }}
                disabled id="{{ $day }}_checkbox" name="checkbox[]"
                value="{{ $day }}" />
            </div>
            <div class="col-sm-2 d-flex align-items-center">
                <label class="col-form-label">{{ ucfirst($day) }}</label>
            </div>
            <div class="col-sm-4">
                <input class="form-control {{ $day }}" type="time" value="{{@$destinationDetails->detail[$day]['open']
                }}" name="timeOpen[]" disabled />
            </div>
            <div class="col-sm-4">
                <input class="form-control {{ $day }}" value="{{@$destinationDetails->detail[$day]['close'] }}"
                    type="time" name="timeClose[]" disabled />
            </div>
        </div>
        @endforeach
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
<script>
    $(document).ready(function () {
        // Open Day Type change event
        $('#open_day_type').on('change', function () {
            if (this.value == 'everyday') {
                if ($('#open_time_type').val() == 'default') {
                    $('#details-form').addClass('d-none');
                }
                $('input[name="checkbox[]"]').prop('checked', true);
                $('input[name="checkbox[]"]').prop("disabled", true);
                $('input[type="time"]').prop('required', true);

            } else {
                $('#details-form').removeClass('d-none');
                $('input[name="checkbox[]"]').prop("disabled", false);
            }
        });

        // Open Time Type change event
        $('#open_time_type').on('change', function () {
            if (this.value == 'default') {
                if ($('#open_day_type').val() == 'everyday') {
                    $('#details-form').addClass('d-none');
                }
                // Get all checked checkboxes and update timeOpen and timeClose
                $('input[name="checkbox[]"]:checked').each(function () {
                    var checkedValue = $(this).val();
                    $('input.' + checkedValue).each(function () {
                        $(this).val('08:00');
                        $(this).prop('disabled', true);
                        $(this).prop('required', true);
                    });
                });
            } else {
                $('#details-form').removeClass('d-none');
                // Enable timeOpen and timeClose
                $('input[name="checkbox[]"]:checked').each(function () {
                    var checkedValue = $(this).val();
                    $('input.' + checkedValue).each(function () {
                        $(this).val('');
                        $(this).prop('disabled', false);
                        $(this).prop('required', true);
                    });
                });
            }
        });

        // Checkbox change event
        $('input[name="checkbox[]"]').on('change', function () {
            if (this.checked) {
                var checkedValue = $(this).val();
                $('input.' + checkedValue).each(function () {

                    if ($('#open_time_type').val() == 'default') {
                        $(this).val('08:00');
                        $(this).prop('disabled', true);
                        $(this).prop('required', true);
                    } else {
                        $(this).val('');
                        $(this).prop('disabled', false);
                        $(this).prop('required', true);
                    }
                });
            } else {
                var checkedValue = $(this).val();
                $('input.' + checkedValue).each(function () {
                    $(this).prop('disabled', true);
                    $(this).val('');
                    $(this).prop('required', false);
                });
            }
        });

        $('#open_day_type').val('{{ @$destinationDetails->open_day_type }}').change();
        $('#open_time_type').val('{{ @$destinationDetails->open_time_type }}').change();
    });
</script>