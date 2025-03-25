<div class="modal fade" id="updateLevelAjaxModal" tabindex="-1" role="dialog" aria-labelledby="updateLevelAjaxModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateLevelAjaxModalLabel">Update Level (AJAX)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="updateLevelAjaxForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="level_id" id="level_id">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="level_code">Code</label>
                                <input type="text" name="level_code" id="level_code" class="form-control">
                                <small class="error-text text-danger" id="error-level_code"></small>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="level_name">Name</label>
                                <input type="text" name="level_name" id="level_name" class="form-control">
                                <small class="error-text text-danger" id="error-level_name"></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning btn-sm" id="updateLevelAjaxButton">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    {{-- Get Level By ID --}}
    <script>
        $(document).on('click', '.update-level-ajax-btn', function() {
            let levelId = $(this).data('id');

            $.ajax({
                url: `/levels/${levelId}/show-ajax`,
                type: 'GET',
                success: function(response) {
                    const data = response.data;
                    $('#updateLevelAjaxModal #level_id').val(data.level_id);
                    $('#updateLevelAjaxModal #level_code').val(data.level_code);
                    $('#updateLevelAjaxModal #level_name').val(data.level_name);
                },
                error: function(xhr) {
                    console.error('Error fetching level data:', xhr);
                }
            });
        });
    </script>

    {{-- Update Level --}}
    <script>
        $(document).on('click', '#updateLevelAjaxButton', function(e) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to update this level.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#updateLevelAjaxForm').submit();
                }
            });
        });

        $(document).ready(function() {
            $('#updateLevelAjaxForm').validate({
                rules: {
                    level_code: {
                        required: true,
                        maxlength: 10,
                    },
                    level_name: {
                        required: true,
                        maxlength: 100,
                    },
                },
                submitHandler: function(form) {
                    const levelId = $('#updateLevelAjaxModal #level_id').val();

                    $.ajax({
                        url: `/levels/${levelId}/update-ajax`,
                        type: 'PATCH',
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.success) {
                                $('#updateLevelAjaxModal').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: response.message
                                });

                                $('#levelsTable').DataTable().ajax.reload();
                            } else {
                                $('.error-text').text('');
                                $.each(response.errors, function(key, value) {
                                    $('#error-' + key).text(value);
                                })

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: response.message
                                });
                            }
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>
@endpush
