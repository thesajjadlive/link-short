@extends('layouts.master')
@php
    $pageTitle ="User Edit";
@endphp
@section('content')
    <div class="page-heading">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="page-title">{{ $pageTitle??'' }}</h1>
            </div>
            <div class="col-sm-6 pt-4 text-right">
                @can('app.users.index')
                    <a href="{{ route('app.users.index') }}" class="btn bg-danger text-white"><i class="fa fa-reply"></i> Back to list</a>
                @endcan
            </div>
        </div>
    </div>
    <div class="page-content fade-in-up">
        <div class="ibox rounded">
            <div class="ibox-body">
                <form method="post" action="{{ route('app.users.update',$user->id) }}" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @if($user)
                        @method('PUT')
                    @endif
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header bg-info">
                                    <h5 class="card-title">User information update</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name <strong class="text-danger">*</strong></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               id="name" name="name" value="{{ $user->name??old('name') }}"
                                               placeholder="Enter user name" />
                                        @error('name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email  <strong class="text-danger">*</strong></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                               id="email" name="email" value="{{ $user->email??old('email') }}"
                                               placeholder="Enter user email" />
                                        @error('email')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="designation">Designation</label>
                                        <input type="text" class="form-control @error('designation') is-invalid @enderror"
                                               id="designation" name="designation" value="{{ $user->designation??old('designation') }}"
                                               placeholder="Enter designation" />
                                        @error('designation')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="contact">Contact</label>
                                        <input type="text" class="form-control @error('contact') is-invalid @enderror"
                                               id="contact" name="contact" value="{{ $user->mobile??old('contact') }}"
                                               placeholder="Enter contact" />
                                        @error('contact')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password  <strong class="text-danger">*</strong></label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                               id="password" name="password" value="{{ old('password') }}"
                                               placeholder="Enter password" />
                                        @error('password')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm Password  <strong class="text-danger">*</strong></label>
                                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                               id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}"
                                               placeholder="Confirm password" />
                                    </div>
                                </div>
                            </div>
                        </div>{{--//.col-md-8--}}
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header bg-info">
                                    <h5 class="card-title">Select role & Status </h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="role">Select Role  <strong class="text-danger">*</strong></label>
                                        <select name="roles[]" id="role" class="form-control" multiple="multiple">
                                            <option  value=" ">Select role</option>
                                            @forelse($roles as $role)

                                                <option   @foreach($user->roles as $roleUser)
                                                          {{ $roleUser->id == $role->id?"selected":"" }}
                                                          @endforeach
                                                          value="{{ $role->id }}">{{ $role->name }}</option>
                                            @empty
                                            @endforelse

                                        </select>
                                        @error('roles')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="avatar">User Avatar</label>
                                        <input type="file" name="avatar" id="avatar" data-default-file="{{ asset($user->image) }}" class="form-control dropify" data-height="150">
                                        @error('avatar')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <div class="check-list">
                                            <label class="ui-radio ui-radio-success">
                                                <input type="radio" {{ $user->status ==1 ?'checked' :'' }} name="status" value="1">
                                                <span class="input-span"></span>Active</label>
                                            <label class="ui-radio ui-radio-danger">
                                                <input type="radio" {{ $user->status ==0 ?'checked' :'' }} name="status" value="0">
                                                <span class="input-span"></span>Inactive</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-arrow-circle-o-up"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endsection
        @push('css')
            <link rel="stylesheet" href="{{ asset('assets/backend/vendors/dropify-master/dist/css/dropify.min.css') }}">
            <link href="{{ asset('assets/backend/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
        @endpush
        @push('js')
            <script src="{{ asset('assets/backend/vendors/dropify-master/dist/js/dropify.min.js') }}"></script>
            <script src="{{ asset('assets/backend/vendors/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
        @endpush
        @push('customJS')
            <script type="text/javascript">
                $('.dropify').dropify();
                $('#role').select2();
            </script>
    @endpush
