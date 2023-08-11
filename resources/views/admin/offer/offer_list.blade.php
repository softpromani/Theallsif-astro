@extends('admin.app')
@section('title')
Dashbard || Offer
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

        @can('offer_create')
        <div class="card-title mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add
            </button>
        </div>
        @endcan

        <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
            <div class="col-md-4 user_role"></div>
            <div class="col-md-4 user_plan"></div>
            <div class="col-md-4 user_status"></div>
        </div>
    </div>

    @can('offer_read')
    <div class="card-datatable table-responsive">
        <table class="datatables table border-top">
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>Image</th>
                    <th>Offer Name</th>
                    <th>Offer Code</th>
                    <th>Offer Type</th>
                    <th>Discount Type</th>
                    <th>Discount Balance</th>
                    <th>Activate Date</th>
                    <th>Deactivate Date</th>
                    <th>Is Active</th>
                    <th>Actions</th>
                </tr>
            </thead>

        </table>

    </div>
    @endcan

</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Offer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('admin.offerStore')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="offer_name" class="form-label">Offer Name</label>
                                <input type="text" class="form-control" id="offer_name" name="offer_name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="select2success" class="form-label">Offer Type</label>
                            <div class="select2-primary" style="z-index: 999999999 !important;">

                                <select id="select2pr" class="select2 form-select" name="offer_type">
                                    <option value="All">All</option>
                                    <option value="Astrologer">Astrologer</option>
                                    <option value="Customer">Customer</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="activate_date" class="form-label">Activate Date</label>
                                <input type="datetime-local" class="form-control" id="activate_date" name="activate_date">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="deactivate_date" class="form-label">Deactivate Date</label>
                                <input type="datetime-local" class="form-control" id="deactivate_date" name="deactivate_date">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="select2success" class="form-label">Discount Type</label>
                            <div class="select2-primary" style="z-index: 999999999 !important;">

                                <select id="select2success" class="select2 form-select" name="discount_type">
                                    <option value="Flat">Flat</option>
                                    <option value="Percentage">Percentage</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="discount_balance" class="form-label">Discount Balance</label>
                                <input type="text" class="form-control" id="discount_balance" name="discount_balance">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-6">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>

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
            ajax: "{!! route('admin.offers') !!}",

            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'imagemedia',
                    name: 'imagemedia   '
                },
                {
                    data: 'offer_name',
                    name: 'offer_name',
                },
                {
                    data: 'offer_code',
                    name: 'offer_code',
                },
                {
                    data: 'offer_type',
                    name: 'offer_type',
                },
                {
                    data: 'discount_type',
                    name: 'discount_type',
                },
                {
                    data: 'discount_balance',
                    name: 'discount_balance',
                },
                {
                    data: 'activate_date',
                    name: 'activate_date',
                },

                {
                    data: 'deactivate_date',
                    name: 'deactivate_date',
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
    });
</script>
<script>
    $(document).ready(function() {
        $(document).on('change', '.is_active', function() {
            var statusId = $(this).data('id');
            var isActive = $(this).is(':checked');
            var newurl = "{{ url('/admin/offer-status') }}/" + statusId;
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