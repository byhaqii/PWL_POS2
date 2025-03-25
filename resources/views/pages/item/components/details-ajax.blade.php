<div class="modal fade" id="detailsItemAjaxModal" tabindex="-1" role="dialog" aria-labelledby="detailsItemAjaxModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsItemAjaxModalLabel">Details Item (AJAX)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <div class="d-flex flex-column gap-1">
                            <p class="fs-5 my-0">ID</p>
                            <p class="my-0" id="item_id">-</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="d-flex flex-column gap-1">
                            <p class="fs-5 my-0">Code</p>
                            <p class="my-0" id="item_code">-</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="d-flex flex-column gap-1">
                            <p class="fs-5 my-0">Name</p>
                            <p class="my-0" id="item_name">-</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="d-flex flex-column gap-1">
                            <p class="fs-5 my-0">Category</p>
                            <p class="my-0" id="category_name">-</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 mt-0 mt-md-3">
                        <div class="d-flex flex-column gap-1">
                            <p class="fs-5 my-0">Buy Price</p>
                            <p class="my-0" id="item_buy_price">-</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 mt-0 mt-md-3">
                        <div class="d-flex flex-column gap-1">
                            <p class="fs-5 my-0">Sell Price</p>
                            <p class="my-0" id="item_sell_price">-</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    {{-- Get Item By ID --}}
    <script>
        $(document).on('click', '.details-item-ajax-btn', function() {
            let itemId = $(this).data('id');

            $.ajax({
                url: `/items/${itemId}/show-ajax`,
                type: 'GET',
                success: function(response) {
                    const data = response.data;
                    const formatCurrency = (value) => {
                        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(value);
                    };

                    $('#detailsItemAjaxModal #item_id').text(data.item_id);
                    $('#detailsItemAjaxModal #item_code').text(data.item_code);
                    $('#detailsItemAjaxModal #item_name').text(data.item_name);
                    $('#detailsItemAjaxModal #category_name').text(data.category_name);
                    $('#detailsItemAjaxModal #item_buy_price').text(formatCurrency(data.item_buy_price));
                    $('#detailsItemAjaxModal #item_sell_price').text(formatCurrency(data.item_sell_price));
                },
                error: function(xhr) {
                    console.error('Error fetching item data:', xhr);
                }
            });
        });
    </script>
@endpush
