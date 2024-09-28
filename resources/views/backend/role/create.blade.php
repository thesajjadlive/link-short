@extends('layouts.master')
@php
    $pageTitle ="Role Create";
@endphp
@section('content')
    <div class="page-heading">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="page-title">{{ $pageTitle ?? '' }}</h1>
            </div>
            <div class="col-sm-6 pt-4 text-right">
                <a href="{{ route('app.roles.index') }}" class="btn bg-danger text-white"><i class="fa fa-reply"></i> Back to list</a>
            </div>
        </div>
    </div>
    <div class="page-content fade-in-up">
        <div class="ibox rounded">
            <div class="ibox-head">
                <div class="ibox-title">Role</div>
            </div>
            <div class="ibox-body">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" action="{{ route('app.roles.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="role_name">Role Name</label>
                                <input type="text" class="form-control @error('role_name') is-invalid @enderror"
                                       id="role_name" name="role_name" value="{{ old('role_name') }}"
                                       placeholder="Enter role name" />
                                @error('role_name')
                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h4 class="mb-0">Manage permissions for role</h4>
                                    <br>
                                    @error('permissions')
                                    <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group text-right">
                                        <label class="ui-checkbox ui-checkbox-success btn-check-all">
                                            <input type="checkbox" id="selectAll">
                                            <span class="input-span inputspan"></span><span
                                                style="margin-bottom: 2px">Select All</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <table class="table table-bordered table-striped">
                                <thead class="bg-secondary text-white">
                                <tr>
                                    <th>Modules</th>
                                    <th>Permissions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($modules as $key=>$module)
                                    <tr>
                                        <td>
                                            <span class="font-weight-bold font-16">{{ $module->name }}</span>
                                            <span class="pull-right mr-4">
                                                <label class="ui-checkbox ui-checkbox-success">
                                                    <input type="checkbox" class="ml-2 moduleCheck"><span class="input-span inputspan"></span>
                                                </label>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="row">
                                                @foreach ($module->permissions as $key => $permission)
                                                    <div class="col ml-4">
                                                        <label for="permission-{{ $permission->id }}"
                                                               class="ui-checkbox ui-checkbox-success">
                                                            <input type="checkbox" class="form-check-input"
                                                                   id="permission-{{ $permission->id }}"
                                                                   value="{{ $permission->id }}" name="permissions[]">
                                                            <span class="input-span"></span>{{ $permission->name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <strong>No module found.</strong>
                                @endforelse
                                </tbody>
                            </table>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-plus-circle"></i> Create
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('js')
@endpush
@push('customJS')
    <script>
        // Listen for click on toggle checkbox
        $('#selectAll').on('click', function() {
            if (this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;
                });
            }
        });

        // Listen for click on module checkbox
        $('.moduleCheck').on('click', function() {
            if (this.checked) {
                // Iterate each checkbox
                $(this).parent().parent().parent().parent().find(':checkbox').each(function(i){
                    this.checked = true;
                });
            } else {
                $(this).parent().parent().parent().parent().find(':checkbox').each(function() {
                    this.checked = false;
                });
            }
        });

    </script>
@endpush
