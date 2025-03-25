@extends('layouts.main')

@section('title', 'Create Level')

@section('contents')
    <div class="card">
        <div class="card-header">
            <p class="my-0 fs-4">Create Level Form</p>
        </div>
        <form action="{{ route('levels.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="level_code">Code</label>
                            <input type="text" name="level_code" id="level_code" class="form-control" value="{{ old('level_code') }}">
                            @error('level_code')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="level_name">Name</label>
                            <input type="text" name="level_name" id="level_name" class="form-control" value="{{ old('level_name') }}">
                            @error('level_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success btn-sm">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
