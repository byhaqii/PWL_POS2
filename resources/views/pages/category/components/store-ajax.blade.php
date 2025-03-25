<div class="modal fade" id="newCategoryAjaxModal" tabindex="-1" role="dialog" aria-labelledby="newCategoryAjaxModalLevel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newCategoryAjaxModalLabel">Create New Category (AJAX)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('categories.store-ajax') }}" method="POST" id="addNewCategoryAjaxForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="category_code">Code</label>
                                <input type="text" name="category_code" id="category_code" class="form-control">
                                <small class="error-text text-danger" id="error-category_code"></small>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="category_name">Name</label>
                                <input type="text" name="category_name" id="category_name" class="form-control" >
                                <small class="error-text text-danger" id="error-category_name"></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-sm">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#addNewCategoryAjaxForm').validate({
                rules: {
                    category_code: {
                        required: true,
                        maxlength: 10,
                    },
                    category_name: {
                        required: true,
                        maxlength: 100,
                    },
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.success) {
                                $('#newCategoryAjaxModal').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: response.message
                                });

                                $('#categoriesTable').DataTable().ajax.reload();
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

                    return false;
                },
                errorElement: 'small',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endpush
