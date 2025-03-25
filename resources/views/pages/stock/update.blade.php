@extends('layouts.main')

@section('title', 'Update Stock')

@section('contents')
    <div class="card">
        <form action="{{ route('stocks.update', ['id' => $stock->stock_id]) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="item_id">Item</label>
                            <select name="item_id" id="item_id" class="form-control">
                                <option value="">Select Item</option>
                                @foreach ($items as $item)
                                    <option value="{{ $item->item_id }}" selected={{ $item->item_id == $stock->item_id ? 'selected' : ''}}>{{ $item->item_name }}</option>
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
                            <input type="text" name="stock_qty" id="stock_qty" class="form-control" value="{{ $stock->stock_qty }}">
                            @error('stock_qty')
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
