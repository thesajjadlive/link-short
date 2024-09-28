@extends('layouts.master')
@php
    $pageTitle = 'Users';
@endphp
@section('content')
    <div class="page-heading">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="page-title">{{ $pageTitle??'' }}</h1>
            </div>
            <div class="col-sm-6 pt-4 text-right">
                @can('app.users.create')
                    <a href="{{ route('app.users.create') }}" class="btn bg-primary text-white"><i class="fa fa-plus-circle"></i> Add New</a>
                @endcan
            </div>
        </div>
    </div>
    <div class="page-content fade-in-up">
        <div class="ibox rounded">
            <div class="ibox-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table style="width: 100%;" id="example"
                               class="table table-hover table-striped table-bordered dataTable dtr-inline" role="grid"
                               aria-describedby="example_info">
                            <thead>
                            <tr role="row">
                                <th>S/N</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Joined At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($users as $key=>$user)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <div class="media">
                                            <img src="{{ $user->image != null ? asset($user->image) : config('app.placeholder') . '100.png' }}"
                                                 width="48" class="rounded-circle mt-2 mr-3" alt="User Avatar">
                                            <div class="media-body">
                                                <h6>{{ $user->name }}</h6>
                                                @foreach ($user->roles as $role )
                                                    <span class="badge bg-info">{{ $role->name ?? '' }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->status == true)
                                            <span class="badge bg-success">Active</span>
                                        @endif
                                        @if ($user->status == false)
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $user->updated_at->diffForHumans() }}
                                    </td>
                                    <td>
                                        @can('app.users.edit')
                                            <a href="{{ route('app.users.edit', $user->id) }}"
                                               class="btn btn-primary" data-toggle="tooltip" data-placement="top"
                                               title="Edit User"><i class="fa fa-pencil"></i></a>
                                        @endcan
                                        @can('app.users.destroy')
                                            <button onclick="deleteUser({{ $user->id }})" type="button"
                                                    class="btn btn-danger" data-toggle="tooltip" data-placement="top"
                                                    title="Delete User">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            <form id="delete-form-{{ $user->id }}"
                                                  action="{{ route('app.users.destroy', $user->id) }}" method="POST"
                                                  style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endcan

                                    </td>
                                </tr>
                            @empty

                            @endforelse
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>S/N</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Joined At</th>
                                <th>Actions</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link href="{{ asset('assets/backend/vendors/DataTables/datatables.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/vendors/sweet-alert/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush
@push('js')
    <script src="{{ asset('assets/backend/vendors/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/sweet-alert/sweetalert2.all.min.js') }}"></script>
@endpush
@push('customCSS')
    <style>
        .swal2-popup .swal2-styled.swal2-cancel {
            border: 0;
            border-radius: .25em;
            background: initial;
            background-color: initial;
            background-color: #ff0505 !important;
            color: #fff;
            font-size: 1.0625em;
        }

    </style>
@endpush
@push('customJS')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        });
        // sweet alert active
        function deleteUser(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-' + id).submit();
                    /* swalWithBootstrapButtons.fire(
                         'Deleted!',
                         'Your file has been deleted.',
                         'success'
                     )*/
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                    )
                }
            })

        }

    </script>
@endpush
