@extends('layouts.main')

@section('title', 'Update Category')

@section('contents')
    <div class="card">
        <form action="{{ route('categories.update', ['id' => $category->category_id]) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="category_code">Code</label>
                            <input type="text" name="category_code" id="category_code" class="form-control"
                                value="{{ $category->category_code }}">
                            @error('category_code')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="category_name">Name</label>
                            <input type="text" name="category_name" id="category_name" class="form-control"
                                value="{{ $category->category_name }}">
                            @error('category_name')
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
