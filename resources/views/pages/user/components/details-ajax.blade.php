<div class="modal fade" id="detailsUserAjaxModal" tabindex="-1" role="dialog" aria-labelledby="detailsUserAjaxModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsUserAjaxModalLabel">Details User (AJAX)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="d-flex flex-column gap-1">
                            <p class="fs-5 my-0">ID</p>
                            <p class="my-0" id="user_id">-</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="d-flex flex-column gap-1">
                            <p class="fs-5 my-0">Username</p>
                            <p class="my-0" id="username">-</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="d-flex flex-column gap-1">
                            <p class="fs-5 my-0">Name</p>
                            <p class="my-0" id="name">-</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="d-flex flex-column gap-1">
                            <p class="fs-5 my-0">Level</p>
                            <p class="my-0" id="level_name">-</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    {{-- Get User By ID --}}
    <script>
        $(document).on('click', '.details-user-ajax-btn', function() {
            let userId = $(this).data('id');

            $.ajax({
                url: `/users/${userId}/show-ajax`,
                type: 'GET',
                success: function(response) {
                    const data = response.data;
                    $('#detailsUserAjaxModal #user_id').text(data.user_id);
                    $('#detailsUserAjaxModal #username').text(data.username);
                    $('#detailsUserAjaxModal #name').text(data.name);
                    $('#detailsUserAjaxModal #level_name').text(data.level.level_name);
                },
                error: function(xhr) {
                    console.error('Error fetching user data:', xhr);
                }
            });
        });
    </script>
@endpush
