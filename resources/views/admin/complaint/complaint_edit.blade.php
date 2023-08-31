@extends('admin.app')
@section('title')
Dashbard || Edit Complaint
@endsection
@section('content-main')
<div class="card">
    <div class="card-header border-bottom">
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


        <div class="card-title">
            <form action="{{route('admin.complaintUpdate',$edit->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="select2success" class="form-label">User Name</label>
                            <div class="select2-primary" style="z-index: 999999999 !important;">
                                @php
                                $users=\App\Models\Customer::get();
                                @endphp
                                <select id="select2success" class="select2 form-select" name="user_id">
                                    @foreach($users as $user)
                                    <option value="{{$user->id}}" {{ isset($edit) ? ($edit->user_id == $user->id ? 'selected' : '') : '' }}>{{$user->phone ?? ''}}/{{$user->role ?? ''}}/{{$user->full_name ?? ''}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 ">
                            <div class="mb-6">
                                <label for="complaint_disc" class="form-label">Complaint Discription</label>
                                <textarea type="text" class="form-control" name="complaint_disc" rows="8">{{$edit->complaint_disc ??''}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="select2pr" class="form-label">Status</label>
                            <div class="select2-primary" style="z-index: 999999999 !important;">
                                <select id="select2pr" class="select2 form-select" name="status">
                                    <option value="Panding" {{ isset($edit) ? ($edit->status == 'Panding' ? 'selected' : '') : '' }}>Panding</option>
                                    <option value="Transfer" {{ isset($edit) ? ($edit->status == 'Transfer' ? 'selected' : '') : '' }}>Transfer</option>
                                    <option value="Complited" {{ isset($edit) ? ($edit->status == 'Complited' ? 'selected' : '') : '' }}>Complited</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>

        </div>

        <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
            <div class="col-md-4 user_role"></div>
            <div class="col-md-4 user_plan"></div>
            <div class="col-md-4 user_status"></div>
        </div>
    </div>


    @can('offer_read')
    <div class="card-datatable table-responsive">
        <div class="col-md-3">
            <label for="select2pr" class="form-label"><b>Status</b></label>
            <div class="select2-primary" style="z-index: 999999999 !important;">
                <select class="select2 form-select select2pr" name="status" id="status-filter">
                    <option>Select Status</option>
                    <option value="Pending">Pending</option>
                    <option value="Transfer">Transfer</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>
        </div>
        <table class="datatables table border-top">
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>User Name</th>
                    <th>User Type</th>
                    <th>Complaint ID</th>
                    <th>Complaint Discreption</th>
                    <th>Status</th>
                    <th>Is Active</th>
                    <th>Actions</th>
                </tr>
            </thead>

        </table>

    </div>
    @endcan
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        var dataTable = $('.datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("admin.complaint") }}', // Change to the correct route
                data: function(d) {
                    d.status = $('#status-filter').val();
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'user_id',
                    name: 'user_id',
                },
                {
                    data: 'user_type',
                    name: 'user_type',
                },
                {
                    data: 'complaint_ticket',
                    name: 'complaint_ticket',
                },
                {
                    data: 'complaint_disc',
                    name: 'complaint_disc',
                },

                {
                    data: 'status',
                    name: 'status',
                },
                {
                    data: 'is_active',
                    name: 'is_active',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },

            ]
        });

        $('#status-filter').on('change', function() {
            dataTable.ajax.reload();
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(document).on('change', '.is_active', function() {
            var statusId = $(this).data('id');
            var isActive = $(this).is(':checked');
            var newurl = "{{ url('/admin/complaint-status') }}/" + statusId;
            $.ajax({
                // url: '/admin/is_active/' + statusId,
                url: newurl,
                type: 'get',
                success: function(response) {
                    location.reload();
                },
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#exampleModal').on('shown.bs.modal', function() {
            $('#select2success').select2({
                dropdownParent: $('#exampleModal')
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#exampleModal').on('shown.bs.modal', function() {
            $('#select2pr').select2({
                dropdownParent: $('#exampleModal')
            });
        });
    });
</script>
@endpush