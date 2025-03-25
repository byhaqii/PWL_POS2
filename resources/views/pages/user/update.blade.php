@extends('layouts.main')

@section('title', 'Update User')

@section('contents')
    <div class="card">
        <form action="{{ route('users.update', ['id' => $user->user_id]) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control"
                                value="{{ $user->username }}">
                            @error('username')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="username">Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ $user->name }}">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="username">Level</label>
                            <select name="level_id" id="level_id" class="form-control">
                                <option value="">Select Level</option>
                                @foreach ($levels as $level)
                                    <option value="{{ $level->level_id }}" selected={{ $level->level_id == $user->level_id ? 'selected' : '' }}>
                                        {{ $level->level_name }}</option>
                                @endforeach
                            </select>
                            @error('level_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="username">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-warning btn-sm">Update</button>
                </div>
            </div>
        </form>
    </div>
@endsection
