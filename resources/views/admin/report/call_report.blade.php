@extends('admin.app')
@section('title')
Dashbard || Call Report
@endsection
@section('content-main')

<!-- Doughnut Chart -->
<div class="col-lg-4 col-12 mb-4">
    <div class="card">
        <h5 class="card-header">User by Astrologer Call</h5>
        <div class="card-body">
            <canvas id="doughnutChart" class="chartjs mb-4" data-height="350"></canvas>
            <ul class="doughnut-legend d-flex justify-content-around ps-0 mb-2 pt-1">
                <li class="ct-series-0 d-flex flex-column">
                    <h5 class="mb-0 fw-bold">Call</h5>
                    <span class="badge badge-dot my-2 cursor-pointer rounded-pill" style="background-color: rgb(102, 110, 232); width: 35px; height: 6px"></span>
                    <div class="text-muted">80 %</div>
                </li>
                <li class="ct-series-1 d-flex flex-column">
                    <h5 class="mb-0 fw-bold">Chat</h5>
                    <span class="badge badge-dot my-2 cursor-pointer rounded-pill" style="background-color: rgb(40, 208, 148); width: 35px; height: 6px"></span>
                    <div class="text-muted">20 %</div>
                </li>
                <!-- <li class="ct-series-2 d-flex flex-column">
                        <h5 class="mb-0 fw-bold">Mobile</h5>
                        <span class="badge badge-dot my-2 cursor-pointer rounded-pill" style="background-color: rgb(253, 172, 52); width: 35px; height: 6px"></span>
                        <div class="text-muted">10 %</div>
                    </li> -->
            </ul>
        </div>
    </div>
</div>
<!-- /Doughnut Chart -->

<div class="card">

    <div class="card-datatable table-responsive">
        <div class="row">
            <!-- <form id="myForm" action="#" method="get" enctype="multipart/form-data"> -->
            <!-- @csrf -->
            <div class="col-md-8 col-8 mb-8">
                <h4>Call Report</h4>
            </div>
            <div class="col-md-4 col-6 mb-4">
                <label for="flatpickr-range" class="form-label">Date Range</label>
                <input type="text" class="form-control date_range flatpickr-input" placeholder="YYYY-MM-DD to YYYY-MM-DD" id="flatpickr-range" name="date_range" readonly="readonly">
            </div>
            <!-- </form> -->
        </div>
        <table class="datatables table border-top">
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Time</th>
                    <th>Customer</th>
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
            ajax: "{{ route('admin.callReport')}}",
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