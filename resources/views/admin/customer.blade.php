@extends('admin.app')
@section('title')
Dashbard || Customer
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
    </div>

    <div class="card-datatable table-responsive">
        <table class="datatables table border-top">
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>Image</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    @if($role !== 'intern')
                    <th>Phone </th>
                    @endif
                    <th>City</th>
                    <th>State</th>
                    <th>Country</th>
                    <th>Actions</th>
                </tr>
            </thead>

        </table>

    </div>


</div>

@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('.datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{!! route('admin.customers') !!}",

            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'image',
                    name: 'image',
                    orderable: true,
                    searchable: false,
                    render: function(data, type, full, meta) {
                        var imagePath = "{{ 'https://8bittask.com/astrologynew/public/images/' }}" + '/' + data;
                        return '<div class="avatar me-2"><img src="' + imagePath + '" alt="Avatar" class="rounded-circle" /></div>';
                    }
                },
                {
                    data: 'first_name',
                    name: 'first_name'
                },
                {
                    data: 'last_name',
                    name: 'last_name'
                },
                {

                    data: 'email',
                    name: 'email'
                },
                // {
                //     data: 'phone',
                //     name: 'phone'
                // },
                @if($role !== 'intern') {
                    data: 'phone',
                    name: 'phone'
                },
                @endif {
                    data: 'city',
                    name: 'city'
                },
                {
                    data: 'state',
                    name: 'state'
                },
                {
                    data: 'country',
                    name: 'country'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },

                // Add more column definitions here
            ]
        });
    });
</script>
@endpush