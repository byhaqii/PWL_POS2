@extends('layouts.main')

@section('title', 'Stocks')

@section('contents')
    {{-- Alert Message --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    
    {{-- Contents --}}
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <p class="my-0 fs-4">Stocks Table</p>
                <div class="d-flex align-items-center">
                    <a href="{{ route('stocks.store-page') }}" class="btn btn-primary btn-sm ml-0 ml-md-2">Create New Stock</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="stocksTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Item Name</th>
                        <th>QTY</th>
                        <th>Created by</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const stocksTable = document.getElementById('stocksTable');

        let stocksDataTable = $(stocksTable).DataTable({
            serverSide: true,
            ajax: {
                url: "{{ route('stocks.list') }}",
                dataType: "JSON",
                type: "GET",
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "item.item_name",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "stock_qty",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "user.name",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "actions",
                    orderable: false,
                    searchable: false
                },
            ],
        });
    </script>
@endpush