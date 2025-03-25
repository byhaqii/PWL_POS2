@extends('layouts.main')

@section('title', 'Update Level')

@section('contents')
    <div class="card">
        <form action="{{ route('levels.update', ['id' => $level->level_id]) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="level_code">Code</label>
                            <input type="text" name="level_code" id="level_code" class="form-control"
                                value="{{ $level->level_code }}">
                            @error('level_code')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="level_name">Name</label>
                            <input type="text" name="level_name" id="level_name" class="form-control"
                                value="{{ $level->level_name }}">
                            @error('level_name')
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
