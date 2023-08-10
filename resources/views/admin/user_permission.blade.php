@extends('admin.app')
@section('title')
Dashbard || User Permission
@endsection
@section('content-main')
@can('assign_permission_create')
<div class="col-12">
    <div class="card">
        <div class="card-header ">
            <h6 class="border-bottom py-1 mb-0 font-medium-2">
                {{ isset($editpermission) ? 'Edit Permission' : 'Assign Permission' }}
            </h6>
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
            <form class="needs-validation" action="{{ route('admin.assignPermission') }}" method='post' enctype="multipart/form-data">
                @csrf
                <div class="col-md-6 mb-1">
                    <label class="form-label" for="desc">Role Name</label>
                    <select class="select2 form-select" id="roleid" name='roleid' required>

                        <option selected disabled value="">--Select Role--</option>

                        @foreach ($roles as $role)
                        <option {{ !isset($editrole) ? '' : ($editrole->id == $role->id ? 'selected' : '') }} value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="card-body px-75">
                    <div class="table-responsive users-view-permission">
                        <table class="table table-borderless">

                            <thead>
                                <tr>
                                    <th>Module</th>
                                    <th>Menu</th>
                                    <th>Read</th>
                                    <th>Create</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($permissions as $per)
                                <tr>
                                    <td>{{ $per->name }}</td>
                                    <td>
                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox2" class="custom-control-input" name="permissionckbx[]" value="{{ $per->name }}" {{ !isset($editrole) ? '' : ($editrole->hasPermissionTo($per->name) ? 'checked' : '') }}>
                                            <label class="custom-control-label" for="users-checkbox2"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox2" class="custom-control-input" name="permissionckbx[]" value="{{ $per->name . '_read' }}" {{ $per->name }}" {{ $per->name }}" {{ !isset($editrole) ? '' : ($editrole->hasPermissionTo($per->name . '_read') ? 'checked' : '') }}><label class="custom-control-label" for="users-checkbox2"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox3" name="permissionckbx[]" class="custom-control-input" value="{{ $per->name . '_create' }}" {{ $per->name . '_create' }}" {{ $per->name }}" {{ $per->name }}" {{ !isset($editrole) ? '' : ($editrole->hasPermissionTo($per->name . '_create') ? 'checked' : '') }}><label class="custom-control-label" for="users-checkbox3"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox1" class="custom-control-input" name="permissionckbx[]" value="{{ $per->name . '_edit' }}" {{ !isset($editrole) ? '' : ($editrole->hasPermissionTo($per->name . '_edit') ? 'checked' : '') }}>
                                            <label class="custom-control-label" for="users-checkbox1"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox1" class="custom-control-input" name="permissionckbx[]" value="{{ $per->name . '_delete' }}" {{ !isset($editrole) ? '' : ($editrole->hasPermissionTo($per->name . '_delete') ? 'checked' : '') }}>
                                            <label class="custom-control-label" for="users-checkbox1"></label>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
</div>
@endcan

@endsection
@push('scripts')
<script>
    $(document).on('change', '#roleid', function() {
        window.location.href = "{{url('admin/user-permission')}}/" + $(this).val();
    });
</script>
@endpush