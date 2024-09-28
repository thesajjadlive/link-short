@extends('layouts.master')
@php
    $pageTitle = 'General Setting';
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
                    <div class="col-md-9 border">
                        <div class="mb-3 btn-transition shadow rounded" style="padding: 10px">
                            <h6>General Settings:</h6>

                        </div>
                        <form action="{{ route('app.setting.general.update') }}" id="settingsFrom" autocomplete="off" role="form" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="site_title">Site Title <strong class="text-danger">(Keep your title under 60 characters if possible)</strong></label>
                                        <input type="text" name="site_title" id="site_title"
                                               class="form-control @error('site_title') is-invalid @enderror"
                                               value="{{ setting('site_title') ?? old('site_title') }}"
                                               placeholder="Site Title">
                                        @error('site_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="site_description">Site Meta Description <strong class="text-danger">(Not more than 160 characters)</strong></label>
                                        <textarea name="site_description" id="site_description"
                                                  class="form-control @error('site_description') is-invalid @enderror">{{ setting('site_description') ?? old('site_description') }}</textarea>
                                        @error('site_description')
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="site_keyword">Site Meta Keywords <strong class="text-danger">(Comma separated value)</strong></label>
                                        <input type="text" name="site_keyword" id="site_keyword"
                                               class="form-control @error('site_keyword') is-invalid @enderror"
                                               value="{{ setting('site_keyword') ?? old('site_keyword') }}"
                                               placeholder="Site Keywords">
                                        @error('site_keyword')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="site_phone">Phone</label>
                                        <input type="text" name="site_phone" id="site_phone"
                                               class="form-control @error('site_phone') is-invalid @enderror"
                                               value="{{ setting('site_phone') ?? old('site_phone') }}"
                                               placeholder="site phone">
                                        @error('site_phone')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="site_email">E-mail</label>
                                        <input type="email" name="site_email" id="site_email"
                                               class="form-control @error('site_email') is-invalid @enderror"
                                               value="{{ setting('site_email') ?? old('site_email') }}"
                                               placeholder="Site email">
                                        @error('site_email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="site_address">Address </label>
                                        <textarea name="site_address" id="site_address"
                                                  class="form-control @error('site_address') is-invalid @enderror">{{ setting('site_address') ?? old('site_address') }}</textarea>
                                        @error('site_address')
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
@push('customCSS')
    <style>


    </style>
@endpush
@push('js')
    <script src="{{ asset('assets/scripts/sweetalert2.all.min.js') }}"></script>
@endpush
@push('customJS')
    <script type="text/javascript">

    </script>
@endpush
