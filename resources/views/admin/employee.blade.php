@extends('admin.app')
@section('title')
Dashbard || Add Permisssion
@endsection
@section('content-main')

@can('employee_create')
<div class="card">
    <div class="card-header">
        <h3>
            @if (!isset($editemployee))
            Add New Employee
            @else
            Edit Employee Details
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
        <form class="needs-validation" action="{{ isset($editemployee) ? route('admin.authuser.update', $editemployee->id) : route('admin.authuser.store') }}" method='post' enctype="multipart/form-data">
            @if (isset($editemployee))
            @method('patch')
            @endif
            @csrf
            <div class="row">
                <div class="col-md-6 mb-1">
                    <label class="form-label" for="basic-addon-name">Name</label>

                    <input type="text" id="basic-addon-name" name='name' class="form-control" value="{{ isset($editemployee) ? $editemployee->name : '' }}" placeholder="Enter name" aria-label="Name" aria-describedby="basic-addon-name" required />
                </div>
                <div class="col-md-6 mb-1">
                    <label class="form-label" for="basic-addon-name">Phone</label>

                    <input type="number" id="basic-addon-name" name='phone' class="form-control" value="{{ isset($editemployee) ? $editemployee->phone : '' }}" placeholder="Enter Phone number" aria-label="Name" aria-describedby="basic-addon-name" required />
                </div>
                <div class="col-md-6 mb-1">
                    <label class="form-label" for="basic-addon-name">Email</label>

                    <input type="text" id="basic-addon-name" name='email' class="form-control" value="{{ isset($editemployee) ? $editemployee->email : '' }}" placeholder="Enter email" aria-label="email" aria-describedby="basic-addon-name" required />
                </div>
                @if (!isset($editemployee))
                <div class="col-md-6 mb-1">
                    <label class="form-label" for="basic-addon-name">Password</label>
                    <input type="text" id="basic-addon-name" name='password' class="form-control" value="{{ isset($editemployee) ? $editemployee->password : '' }}" placeholder="Enter password" aria-label="password" aria-describedby="basic-addon-name" required />
                </div>
                @endif
                <div class="col-md-6 mb-1">
                    <label class="form-label" for="desc">Role Name</label>
                    <select class="select2 form-select" id="select2-basic" name='roleid' required>
                        @if (isset($editemployee))
                        <option selected hidden value='{{ $editemployee->roles[0]->id ?? '' }}'>
                            {{ $editemployee->roles[0]->name ?? '' }}
                        </option>
                        @else
                        <option selected disabled value="">--Select Role--</option>
                        @endif
                        @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-1">
                    <label class="form-label" for="pic">Image Thumbnail</label>
                    <input type="file" name='pic' id="pic" class="form-control " aria-label="pic" aria-describedby="pic" />
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary waves-effect waves-float waves-light">{{ isset($editemployee) ? 'Update' : 'Add' }}</button>
                </div>
                @if (isset($editemployee))
                <div class="col-sm-6">
                    <img src="{{ asset($editemployee->pic) }}" class="bg-light-info" alt="" style="height:100px;width:100px;">
                </div>
                @endif
            </div>

        </form>
    </div>
</div>
@endcan

@can('employee_read')
<div class="card">
    <div class="card-header">
        <h3>Manage Employees</h3>
    </div>
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
    <div class="card-body" style="overflow-y: auto;">
        <table class="display nowrap" id="employee" style="width:100% !important;">
            <thead>
                <tr>
                    <th>Sr.No</th>

                    <th>Image</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>

                </tr>

            </thead>
            <tbody>
                @foreach ($employees as $employee)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>

                    <td>
                        <img src="{{ asset($employee->pic) }}" class="me-75 bg-light-danger" style="height:60px;width:60px;" />
                    </td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->phone }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->roles[0]->name ?? '' }}</td>


                    <td>
                        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                            <div class="mb-1 breadcrumb-right">
                                <div class="dropdown">
                                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        @php $eid=Crypt::encrypt($employee->id); @endphp
                                        @if (Auth::user()->roles[0]->name == 'superadmin')
                                        <a class="dropdown-item" href="{{ route('admin.loginUsingId', $eid) }}"><i class="me-1" data-feather="check-square"></i><span class="align-middle">Login As</span>
                                        </a>
                                        @endif
                                        @can('employee_edit')
                                        <a class="dropdown-item" href="{{ route('admin.authuser.edit', $eid) }}"><i class="me-1" data-feather="check-square"></i><span class="align-middle">Edit</span>
                                        </a>
                                        @endcan
                                        @can('employee_delete')
                                        <a class="dropdown-item" href="" onclick="event.preventDefault();document.getElementById('delete-form-{{ $eid }}').submit();"><i class="me-1" data-feather="message-square"></i><span class="align-middle">Delete</span>
                                        </a>
                                        @endcan

                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>

                <form id="delete-form-{{ $eid }}" action="{{ route('admin.authuser.destroy', $eid) }}" method="post" style="display: none;">
                    @method('DELETE')
                    @csrf
                </form>

                @endforeach

            </tbody>
        </table>
    </div>
</div>
@endcan


@endsection
@push('scripts')

@endpush