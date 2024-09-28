@extends('layouts.master')
@php
$pageTitle = 'Roles';
@endphp
@section('content')
    <div class="page-heading">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="page-title">{{ $pageTitle ?? '' }}</h1>
            </div>
            <div class="col-sm-6 pt-4 text-right">
                <a href="{{ route('app.roles.create') }}" class="btn bg-primary text-white"><i class="fa fa-plus-circle"></i> Add New</a>
            </div>
        </div>
    </div>

    <div class="page-content fade-in-up">

        <div class="ibox rounded">
            <div class="ibox-head">
                <div class="ibox-title">Role</div>
            </div>
            <div class="ibox-body">
                <table class="table table-striped table-bordered table-hover" id="example" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr role="row">
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Permissions</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $key=>$role)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @if ($role->permissions->count() > 0)
                                        <div class="badge bg-info">{{ $role->permissions->count() }}</div>
                                    @else
                                        <span class="bg-warning">No permissions found (:</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $role->updated_at->diffForHumans() }}
                                </td>
                                <td>
                                    <a href="{{ route('app.roles.edit', $role->id) }}" class="btn btn-success btn-sm"
                                        data-toggle="tooltip" data-placement="top" title="Edit Role"><i
                                            class="fa fa-pencil-square-o"></i></a>
                                    @if ($role->deletable == true)
                                        <button onclick="deleteRole({{ $role->id }})" type="button"
                                            class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"
                                            title="Delete Role">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                        <form id="delete-form-{{ $role->id }}"
                                            action="{{ route('app.roles.destroy', $role->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty

                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Permissions</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                </table>
                </table>
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
        function deleteRole(id) {
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
