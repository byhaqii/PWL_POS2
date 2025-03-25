<div class="modal fade" id="detailsCategoryAjaxModal" tabindex="-1" role="dialog" aria-labelledby="detailsCategoryAjaxModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsCategoryAjaxModalLabel">Details Category (AJAX)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="d-flex flex-column gap-1">
                            <p class="fs-5 my-0">Code</p>
                            <p class="my-0" id="category_code">-</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="d-flex flex-column gap-1">
                            <p class="fs-5 my-0">Name</p>
                            <p class="my-0" id="category_name">-</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    {{-- Get Category By ID --}}
    <script>
        $(document).on('click', '.details-category-ajax-btn', function() {
            let categoryId = $(this).data('id');

            $.ajax({
                url: `/categories/${categoryId}/show-ajax`,
                type: 'GET',
                success: function(response) {
                    const data = response.data;
                    $('#detailsCategoryAjaxModal #category_code').text(data.category_code);
                    $('#detailsCategoryAjaxModal #category_name').text(data.category_name);
                },
                error: function(xhr) {
                    console.error('Error fetching category data:', xhr);
                }
            });
        });
    </script>
@endpush
