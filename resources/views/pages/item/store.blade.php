@extends('layouts.main')

@section('title', 'Create Item')

@section('contents')
    <div class="card">
        <div class="card-header">
            <p class="my-0 fs-4">Create Item Form</p>
        </div>
        <form action="{{ route('items.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="item_code">Code</label>
                            <input type="text" name="item_code" id="item_code" class="form-control" value="{{ old('item_code') }}">
                            @error('item_code')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="item_name">Name</label>
                            <input type="text" name="item_name" id="item_name" class="form-control" value="{{ old('item_name') }}">
                            @error('item_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="item_buy_price">Buy Price</label>
                            <input type="number" name="item_buy_price" id="item_buy_price" class="form-control" value="{{ old('item_buy_price') }}">
                            @error('item_buy_price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="item_sell_price">Sell Price</label>
                            <input type="text" name="item_sell_price" id="item_sell_price" class="form-control" value="{{ old('item_sell_price') }}">
                            @error('item_sell_price')
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
