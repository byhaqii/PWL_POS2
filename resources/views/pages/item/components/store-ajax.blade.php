<div class="modal fade" id="newItemAjaxModal" tabindex="-1" role="dialog" aria-labelledby="newItemAjaxModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newItemAjaxModalLabel">Create New Item (AJAX)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('items.store-ajax') }}" method="POST" id="addNewItemAjaxForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="item_code">Code</label>
                                <input type="text" name="item_code" id="item_code" class="form-control">
                                <small class="error-text text-danger" id="error-item_code"></small>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="item_name">Name</label>
                                <input type="text" name="item_name" id="item_name" class="form-control">
                                <small class="error-text text-danger" id="error-item_name"></small>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                <small class="error-text text-danger" id="error-category_id"></small>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="item_buy_price">Buy Price</label>
                                <input type="number" name="item_buy_price" id="item_buy_price" class="form-control">
                                <small class="error-text text-danger" id="error-item_buy_price"></small>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="item_sell_price">Sell Price</label>
                                <input type="text" name="item_sell_price" id="item_sell_price" class="form-control">
                                <small class="error-text text-danger" id="error-item_sell_price"></small>
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
            $('#addNewItemAjaxForm').validate({
                rules: {
                    item_code: {
                        required: true,
                        maxlength: 10,
                    },
                    item_name: {
                        required: true,
                        maxlength: 100,
                    },
                    category_id: {
                        required: true,
                    },
                    item_buy_price: {
                        required: true,
                    },
                    item_sell_price: {
                        required: true,
                    },
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.success) {
                                $('#newItemAjaxModal').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: response.message
                                });

                                $('#itemsTable').DataTable().ajax.reload();
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
