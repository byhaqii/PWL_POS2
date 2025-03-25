@extends('layouts.main')

@section('title', 'Details Level')

@section('contents')
    <div class="card">
        <div class="card-header">
            <p class="fs-5 my-0">Level Details Data</p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="d-flex flex-column gap-1">
                        <p class="fs-5 my-0">ID</p>
                        <p class="my-0">{{ $level->level_id }}</p>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="d-flex flex-column gap-1">
                        <p class="fs-5 my-0">Code</p>
                        <p class="my-0">{{ $level->level_code }}</p>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="d-flex flex-column gap-1">
                        <p class="fs-5 my-0">Name</p>
                        <p class="my-0">{{ $level->level_name }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-end">
                <a href="{{ route('levels.page')}}" class="btn btn-danger btn-sm">Back</a>
            </div>
        </div>
    </div>
@endsection