<div class="modal fade" id="detailsLevelAjaxModal" tabindex="-1" role="dialog" aria-labelledby="detailsLevelAjaxModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsLevelAjaxModalLabel">Details Level (AJAX)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="d-flex flex-column gap-1">
                            <p class="fs-5 my-0">Code</p>
                            <p class="my-0" id="level_code">-</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="d-flex flex-column gap-1">
                            <p class="fs-5 my-0">Name</p>
                            <p class="my-0" id="level_name">-</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    {{-- Get Level By ID --}}
    <script>
        $(document).on('click', '.details-level-ajax-btn', function() {
            let levelId = $(this).data('id');

            $.ajax({
                url: `/levels/${levelId}/show-ajax`,
                type: 'GET',
                success: function(response) {
                    const data = response.data;
                    $('#detailsLevelAjaxModal #level_code').text(data.level_code);
                    $('#detailsLevelAjaxModal #level_name').text(data.level_name);
                },
                error: function(xhr) {
                    console.error('Error fetching level data:', xhr);
                }
            });
        });
    </script>
@endpush
