@extends('admin.app')
@section('title')
Dashbard || User Permission
@endsection
@section('content-main')

<div class="card">
    <div class="card-header">
        <h3>
            @if (!isset($brandedit))
            Assign Role To Employee
            @else
            Update Assigned Role
            @endif
        </h3>
    </div>
    <div class="card-body">
        <form class="needs-validation" action="{{ route('admin.assignUserRole') }}" method='post' enctype="multipart/form-data">
            @if (isset($modeledit))
            @method('patch')
            @endif
            @csrf
            <div class="row">
                <div class="col-md-6 mb-1">
                    <label class="form-label" for="desc">User Name</label>
                    <select class="select2 form-select" id="select2-basic" name='userid' required>
                        @if (isset($modeledit))
                        <option selected hidden value='{{ $modeledit->id }}'>{{ $modeledit->brand->name }}</option>
                        @else
                        <option selected disabled value="">--Select User--</option>
                        @endif

                        @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}">
                            {{ $employee->name ? "$employee->name / " : '' }}{{ $employee->phone }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-1">
                    <label class="form-label" for="desc">Role Name</label>
                    <select class="select2 form-select" id="select2-basic" name='roleid' required>
                        @if (isset($modeledit))
                        <option value='{{ $modeledit->id }}'>{{ $modeledit->brand->name }}</option>
                        @else
                        <option selected disabled value="">--Select Role--</option>
                        @endif

                        @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary waves-effect waves-float waves-light">{{ isset($modeledit) ? 'Update' : 'Assign' }}</button>
                </div>
            </div>

        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3>Manage User Roles</h3>
    </div>
    <div class="card-body">
        {{-- <table class="datatables-basic table datatable table-responsive"> --}}
        <table class="display nowrap" id="userrole" style="width:100% !important;">
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>User Name</th>
                    <th>Role Name</th>
                    <th>Action</th>
                </tr>

            </thead>
            <tbody>
                @foreach ($employees as $employee)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $employee->name ? "$employee->name / " : '' }}{{ $employee->phone }}</td>
                    <td>{{ $employee->roles[0]->name ?? '' }}</td>
                    <td>
                        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                            <div class="mb-1 breadcrumb-right">
                                <div class="dropdown">
                                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        @php $uid=Crypt::encrypt($employee->id); @endphp
                                        <a class="dropdown-item" href="#"><i class="me-1" data-feather="check-square"></i><span class="align-middle">Edit</span></a>
                                        <a class="dropdown-item" href="" onclick="event.preventDefault();"><i class="me-1" data-feather="message-square"></i><span class="align-middle">Delete</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                {{-- <form id="delete-form-{{ $uid }}" action="#"
                method="post" style="display: none;">
                @method('DELETE')
                @csrf
                </form> --}}
                @endforeach

            </tbody>
        </table>
    </div>
    {{-- <div class="card-footer">
            {!! $models->links('pagination::bootstrap-5') !!}
        </div> --}}
</div>

@endsection
@push('scripts')

@endpush