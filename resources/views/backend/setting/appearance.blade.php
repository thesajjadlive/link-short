@extends('layouts.master')
@php
    $pageTitle = 'Appearance Setting';
@endphp
@section('content')

    <div class="page-heading">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="page-title">{{ $pageTitle??'' }}</h1>
            </div>
            <div class="col-sm-6 pt-4 text-right">

            </div>
        </div>
    </div>
    <div class="page-content fade-in-up">
        <div class="ibox rounded">
            <div class="ibox-body">
                <div class="row">
                    <div class="col-md-3">
                        @include('backend.setting.sidebar')
                    </div>
                    <div class="col-md-9">
                        <form action="{{ route('app.setting.appearance.update') }}" id="settingsFrom" autocomplete="off" role="form" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="site_logo">Site Logo<strong class="text-danger">*</strong> (Only image are allowed)</label>
                                        <input type="file" required
                                               name="site_logo"
                                               id="site_logo"
                                               data-default-file="{{ setting('site_logo') !=null ? asset(setting('site_logo')):'' }}"
                                               class="form-control dropify  @error('site_logo') is-invalid @enderror" data-height="150">
                                        @error('site_logo')
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="site_favicon">Site Favicon<strong class="text-danger">*</strong> (Only image are allowed,Size: 32 x 32)</label>
                                        <input type="file" required
                                               name="site_favicon"
                                               id="site_favicon"
                                               data-default-file="{{ setting('site_favicon') !=null ?asset(setting('site_favicon')):'' }}"
                                               class="form-control dropify  @error('site_favicon') is-invalid @enderror" data-height="150">
                                        @error('site_favicon')
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                        @enderror
                                    </div>


                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-arrow-circle-up"></i>
                                        <span>Update</span>
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/dropify-master/dist/css/dropify.min.css') }}">
@endpush
@push('js')
    <script src="{{ asset('assets/backend/vendors/dropify-master/dist/js/dropify.min.js') }}"></script>
@endpush
@push('customJS')
    <script type="text/javascript">
        $('.dropify').dropify();
    </script>
@endpush

