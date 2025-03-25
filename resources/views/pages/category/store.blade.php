@extends('layouts.main')

@section('title', 'Create Level')

@section('contents')
    <div class="card">
        <div class="card-header">
            <p class="my-0 fs-4">Create Category Form</p>
        </div>
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="category_code">Code</label>
                            <input type="text" name="category_code" id="category_code" class="form-control" value="{{ old('category_code') }}">
                            @error('category_code')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="category_name">Name</label>
                            <input type="text" name="category_name" id="category_name" class="form-control" value="{{ old('category_name') }}">
                            @error('category_name')
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
