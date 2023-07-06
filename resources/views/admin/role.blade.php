@extends('admin.app')
@section('title')
Dashbard || Add Role
@endsection
@section('content-main')
<div class="card">
    <div class="card-header">
        <h3>
            @if (!isset($editrole))
            Add New Role
            @else
            Update Role
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
        <form class="needs-validation" action="{{ isset($editrole) ? route('admin.role.update', $editrole->id) : route('admin.role.store') }}" method='post' enctype="multipart/form-data">
            @if (isset($editrole))
            @method('patch')
            @endif
            @csrf
            <div class="row">
                <div class="col-md-6 mb-1">
                    <label class="form-label" for="basic-addon-name">Role Name</label>

                    <input type="text" id="basic-addon-name" name='name' class="form-control" value="{{ isset($editrole) ? $editrole->name : '' }}" placeholder="Role Name" aria-label="Name" aria-describedby="basic-addon-name" required />
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary waves-effect waves-float waves-light">{{ isset($editrole) ? 'Update' : 'Add' }}</button>
                </div>
            </div>

        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3>Manage Roles</h3>
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
                @foreach ($roles as $role)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->created_at }}</td>
                    <td>
                        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                            <div class="mb-1 breadcrumb-right">
                                <div class="dropdown">
                                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        @php $rid=Crypt::encrypt($role->id); @endphp
                                        <a class="dropdown-item" href="{{ route('admin.role.edit', $rid) }}"><i class="me-1" data-feather="check-square"></i><span class="align-middle">Edit</span></a>
                                        <a class="dropdown-item" href="" onclick="event.preventDefault();document.getElementById('delete-form-{{ $rid }}').submit();"><i class="me-1" data-feather="message-square"></i><span class="align-middle">Delete</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <form id="delete-form-{{ $rid }}" action="{{ route('admin.role.destroy', $rid) }}" method="post" style="display: none;">
                    @method('DELETE')
                    @csrf
                </form>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
@endsection
@push('scripts')

@endpush