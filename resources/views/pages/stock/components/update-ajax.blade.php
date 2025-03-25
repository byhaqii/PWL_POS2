<div class="modal fade" id="updateStockAjaxModal" tabindex="-1" role="dialog" aria-labelledby="updateStockAjaxModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateLevelAjaxModalLabel">Update Level (AJAX)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="updateStockAjaxForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="stock_id" id="stock_id">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="item_id">Item</label>
                                <select name="item_id" id="item_id" class="form-control">
                                    <option value="">Select Item</option>
                                    @foreach ($items as $item)
                                        <option value="{{ $item->item_id }}">{{ $item->item_name }}</option>
                                    @endforeach
                                </select>
                                <small class="error-text text-danger" id="error-item_id"></small>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="stock_qty">Quantity</label>
                                <input type="number" name="stock_qty" id="stock_qty" class="form-control">
                                <small class="error-text text-danger" id="error-stock_qty"></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning btn-sm" id="updateStockAjaxButton">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    {{-- Get Stock By ID --}}
    <script>
        $(document).on('click', '.update-stock-ajax-btn', function() {
            let stockId = $(this).data('id');

            $.ajax({
                url: `/stocks/${stockId}/show-ajax`,
                type: 'GET',
                success: function(response) {
                    const data = response.data;
                    $('#updateStockAjaxModal #stock_id').val(data.stock_id);
                    $('#updateStockAjaxModal #item_id').val(data.item_id);
                    $('#updateStockAjaxModal #stock_qty').val(data.stock_qty);
                },
                error: function(xhr) {
                    console.error('Error fetching stock data:', xhr);
                }
            });
        });
    </script>

    {{-- Update Stock --}}
    <script>
        $(document).on('click', '#updateStockAjaxButton', function(e) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to update this stock.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#updateStockAjaxForm').submit();
                }
            });
        });

        $(document).ready(function() {
            $('#updateStockAjaxForm').validate({
                rules: {
                    item_id: {
                        required: true,
                    },
                    stock_qty: {
                        required: true,
                    },
                },
                submitHandler: function(form) {
                    const stockId = $('#updateStockAjaxModal #stock_id').val();

                    $.ajax({
                        url: `/stocks/${stockId}/update-ajax`,
                        type: 'PATCH',
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.success) {
                                $('#updateStockAjaxModal').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: response.message
                                });

                                $('#stocksTable').DataTable().ajax.reload();
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
