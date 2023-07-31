@extends('admin.app')
@section('title')
Dashbard || Revenue Report
@endsection
@section('content-main')


<div class="col-12 mb-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-md-center align-items-start">
            <h5 class="card-title mb-0">Revenue Report</h5>
            <div class="dropdown">
                <button type="button" class="btn dropdown-toggle p-0" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ti ti-calendar"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Today</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Yesterday</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 7 Days</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 30 Days</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Current Month</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last Month</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            <div id="barChart"></div>
        </div>
    </div>
</div>


@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('.datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.chatReport')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },

                {
                    data: 'first_name',
                    name: 'first_name'
                },
                {
                    data: 'last_name',
                    name: 'last_name'
                },

                // Add more column definitions here
            ]
        });
    });
</script>

<!-- <script>
    $(document).ready(function() {
        $(document).on('keyup', '.data_range', function() {
            alert('hii');
            var formData = $('#myForm').serialize();
            var newurl = "{{ url('/admin/chat-report') }}";
            $.ajax({
                // url: '/admin/charge-store',
                url: newurl,
                type: 'get',
                data: formData,
                success: function(response) {
                    alert(response.message);
                    location.reload();
                },
            });

        });
    });
</script> -->
@endpush