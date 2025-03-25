<div class="modal fade" id="detailsStockAjaxModal" tabindex="-1" role="dialog" aria-labelledby="detailsStockAjaxModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsStockAjaxModalLabel">Details Stock (AJAX)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <div class="d-flex flex-column gap-1">
                            <p class="fs-5 my-0">ID</p>
                            <p class="my-0" id="stock_id">-</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="d-flex flex-column gap-1">
                            <p class="fs-5 my-0">Item Name</p>
                            <p class="my-0" id="item_name">-</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="d-flex flex-column gap-1">
                            <p class="fs-5 my-0">Quantity</p>
                            <p class="my-0" id="stock_qty">-</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="d-flex flex-column gap-1">
                            <p class="fs-5 my-0">Created by</p>
                            <p class="my-0" id="created_by">-</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    {{-- Get Stock By ID --}}
    <script>
        $(document).on('click', '.details-stock-ajax-btn', function() {
            let stockId = $(this).data('id');

            $.ajax({
                url: `/stocks/${stockId}/show-ajax`,
                type: 'GET',
                success: function(response) {
                    const data = response.data;
                    $('#detailsStockAjaxModal #stock_id').text(data.stock_id);
                    $('#detailsStockAjaxModal #item_name').text(data.item.item_name);
                    $('#detailsStockAjaxModal #stock_qty').text(data.stock_qty);
                    $('#detailsStockAjaxModal #created_by').text(data.user.name);
                },
                error: function(xhr) {
                    console.error('Error fetching stock data:', xhr);
                }
            });
        });
    </script>
@endpush
