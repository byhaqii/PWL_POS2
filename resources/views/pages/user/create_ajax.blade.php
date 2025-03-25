<form id="userForm" action="{{ url('user/store_ajax') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Username:</label>
        <input type="text" name="username" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Name:</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Email:</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
</form>