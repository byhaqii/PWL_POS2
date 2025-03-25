@extends('layouts.main')

@section('title', 'Create Level')

@section('contents')
    <div class="card">
        <div class="card-header">
            <p class="my-0 fs-4">Create Stock Form</p>
        </div>
        <form action="{{ route('stocks.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="item_id">Item</label>
                            <select name="item_id" id="item_id" class="form-control">
                                <option value="">Select Item</option>
                                @foreach ($items as $item)
                                    <option value="{{ $item->item_id }}">{{ $item->item_name }}</option>
                                @endforeach
                            </select>
                            @error('item_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="stock_qty">Quantity</label>
                            <input type="number" name="stock_qty" id="stock_qty" class="form-control" value="{{ old('stock_qty') }}">
                            @error('stock_qty')
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
