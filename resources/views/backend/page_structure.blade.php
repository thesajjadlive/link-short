@extends('layouts.master')
@php

@endphp
@section('content')
    <div class="page-heading">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="page-title">{{ $page_title??'Page Title' }}</h1>
            </div>
            <div class="col-sm-6 pt-4 text-right">
                <a href="#" class="btn bg-primary text-white"><i class="fa fa-plus-circle"></i> Add New</a>
            </div>
        </div>
    </div>
    <div class="page-content fade-in-up">
        <div class="ibox rounded">
            <div class="ibox-body">
                <div class="row">
                    <div class="col-sm-12">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link href="{{ asset('assets/backend/vendors/sweet-alert/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush
@push('js')
    <script src="{{ asset('assets/backend/vendors/sweet-alert/sweetalert2.all.min.js') }}"></script>
@endpush
@push('customCSS')
    <style>

    </style>
@endpush
@push('customJS')
    <script>

    </script>
@endpush
