<div class="modal fade" id="updateCategoryAjaxModal" tabindex="-1" role="dialog" aria-labelledby="updateCategoryAjaxModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateCategoryAjaxModalLabel">Update Category (AJAX)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="updateCategoryAjaxForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="category_id" id="category_id">
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
                    <button type="button" class="btn btn-warning btn-sm" id="updateCategoryAjaxButton">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    {{-- Get Category By ID --}}
    <script>
        $(document).on('click', '.update-category-ajax-btn', function() {
            let categoryId = $(this).data('id');

            $.ajax({
                url: `/categories/${categoryId}/show-ajax`,
                type: 'GET',
                success: function(response) {
                    const data = response.data;
                    $('#updateCategoryAjaxModal #category_id').val(data.category_id);
                    $('#updateCategoryAjaxModal #category_code').val(data.category_code);
                    $('#updateCategoryAjaxModal #category_name').val(data.category_name);
                },
                error: function(xhr) {
                    console.error('Error fetching category data:', xhr);
                }
            });
        });
    </script>

    {{-- Update Category --}}
    <script>
        $(document).on('click', '#updateCategoryAjaxButton', function(e) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to update this category.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#updateCategoryAjaxForm').submit();
                }
            });
        });

        $(document).ready(function() {
            $('#updateCategoryAjaxForm').validate({
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
                    const categoryId = $('#updateCategoryAjaxModal #category_id').val();

                    $.ajax({
                        url: `/categories/${categoryId}/update-ajax`,
                        type: 'PATCH',
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.success) {
                                $('#updateCategoryAjaxModal').modal('hide');
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
                }
            });
        });
    </script>
@endpush
