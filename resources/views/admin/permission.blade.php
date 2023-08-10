@extends('admin.app')
@section('title')
Dashbard || Add Permisssion
@endsection
@section('content-main')

@can('permission_create')
<div class="card">
    <div class="card-header">
        <h3>
            @if (!isset($editpermission))
            Add New Permission
            @else
            Update Permission
            @endif
        </h3>

    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <div class="card-body">
        <form class="needs-validation" action="{{ route('admin.permission.store') }}" method='post' enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-1">
                    <label class="form-label" for="basic-addon-name">Permission Name</label>

                    <input type="text" id="basic-addon-name" name='name' class="form-control" value="{{ isset($editpermission) ? $editpermission->name : '' }}" placeholder="Permission Name" aria-label="Name" aria-describedby="basic-addon-name" required />
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary waves-effect waves-float waves-light">{{ isset($editpermission) ? 'Update' : 'Add' }}</button>
                </div>
            </div>

        </form>
    </div>
</div>
@endcan
@can('permission_read')
<div class="card">
    <div class="card-header">
        <h3>Manage Permissions</h3>
    </div>
    <div class="card-body">
        <table class="datatables-basic table datatable table-responsive">

            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Name</th>
                    <th>Created at</th>
                    <th>Action</th>
                </tr>

            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->created_at }}</td>
                    <td>
                        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                            <div class="mb-1 breadcrumb-right">
                                <div class="dropdown">
                                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        @php $cid=Crypt::encrypt($permission->id); @endphp
                                        @can('permission_edit')
                                        <a class="dropdown-item" href="#"><i class="me-1" data-feather="check-square"></i><span class="align-middle">Edit</span></a>
                                        @endcan
                                        <!-- onclick="event.preventDefault();document.getElementById('delete-form-{{ $cid }}').submit();" -->
                                        <!-- {{ route('admin.permission.edit', $cid) }} -->
                                        @can('permission_delete')
                                        <a class="dropdown-item" href=""><i class="me-1" data-feather="message-square"></i><span class="align-middle">Delete</span></a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <form id="delete-form-{{ $cid }}" action="{{ route('admin.permission.destroy', $cid) }}" method="post" style="display: none;">
                    @method('DELETE')
                    @csrf
                </form>
                @endforeach
                {{-- <tr>
                        <td>1</td>
                        <td>Create Brand</td>
                        <td>Admin</td>
                        <td>123847829</td>
                    </tr> --}}

            </tbody>
        </table>
    </div>
</div>
@endcan

@endsection
@push('scripts')

@endpush