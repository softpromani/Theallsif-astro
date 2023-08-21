@extends('admin.app')
@section('title')
Dashbard || Edit Offer
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
            <form action="{{route('admin.offerUpdate',$edit->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="offer_name" class="form-label">Coupan Name</label>
                                <input type="text" class="form-control" id="offer_name" name="offer_name" value="{{$edit->offer_name ?? ''}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="select2success" class="form-label">Coupan Type</label>
                            <div class="select2-primary" style="z-index: 999999999 !important;">

                                <select id="select2pr" class="select2 form-select" name="offer_type">
                                    <option value="Normal" {{isset($edit)?($edit->offer_type =='Normal' ? 'selected':''):''}}>Normal</option>
                                    <option value="Astrologer Wise" {{isset($edit)?($edit->offer_type =='Astrologer Wise' ? 'selected':''):''}}>Astrologer Wise</option>
                                    <option value="Customer Wise" {{isset($edit)?($edit->offer_type =='Customer Wise' ? 'selected':''):''}}>Customer Wise</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="activate_date" class="form-label">Activate Date</label>
                                <input type="datetime-local" class="form-control" id="activate_date" name="activate_date" value="{{$edit->activate_date ??''}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="deactivate_date" class="form-label">Deactivate Date</label>
                                <input type="datetime-local" class="form-control" id="deactivate_date" name="deactivate_date" value="{{$edit->deactivate_date ??''}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="select2success" class="form-label">Discount Type</label>
                            <div class="select2-primary" style="z-index: 999999999 !important;">

                                <select id="select2success" class="select2 form-select" name="discount_type">
                                    <option value="Flat" {{isset($edit)?($edit->discount_type =='Flat' ? 'selected':''):''}}>Flat</option>
                                    <option value="Percentage" {{isset($edit)?($edit->discount_type =='Percentage' ? 'selected':''):''}}>Percentage</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="discount" class="form-label">Discount</label>
                                <input type="text" class="form-control" id="discount" name="discount" value="{{$edit->discount ??''}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="min_order_value" class="form-label">Min Order Value</label>
                                <input type="text" class="form-control" id="min_order_value" name="min_order_value" value="{{$edit->min_order_value ??''}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="max_discount_value" class="form-label">Max Discount Value</label>
                                <input type="text" class="form-control" id="max_discount_value" name="max_discount_value" value="{{$edit->max_discount_value ??''}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <img src="{{$edit->offerimages->first()->img}}" alt="" srcset="" height="50px" width="50px">
                        </div>
                        <div class="col-md-5">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>

                        <div class="col-md-6 " id="coupan-wise">

                            <label for="select2pro" class="form-label">Coupan By Person</label>
                            <div class="select2-primary" style="z-index: 999999999 !important;">

                                <select id="select2pro" class="select2 form-select @if($users) @else d-none @endif" name="user_id[]" multiple>
                                    @if($users)
                                    @forelse ($users as $user)
                                    <option value="{{ $user->id }}" {{ isset($edit) ? (in_array($user->id, json_decode($edit->user_id)) ? 'selected' : '' ) : ''  }}>{{ $user->name ?? '' }}</option>
                                    @empty
                                    <option>No data found</option>
                                    @endforelse
                                    @endif
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
        <table class="datatables table border-top">
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>Image</th>
                    <th>Coupan Name</th>
                    <th>Coupan Code</th>
                    <th>Coupan Type</th>
                    <th>Discount Type</th>
                    <th>Discount</th>
                    <th>Max Discount Value</th>
                    <th>Min Order Value</th>
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
                    data: 'discount',
                    name: 'discount',
                },

                {
                    data: 'max_discount_value',
                    name: 'max_discount_value',
                },

                {
                    data: 'min_order_value',
                    name: 'min_order_value',
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
<script>
    $(document).ready(function() {
        $('#exampleModal').on('shown.bs.modal', function() {
            $('#select2pro').select2({
                dropdownParent: $('#exampleModal')
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $("#select2pr").change(function() {
            $('#coupan-wise').hide();
            $(this).find("option:selected").each(function() {
                var optionValue = $(this).attr("value");
                if (optionValue == 'Astrologer Wise' || optionValue == 'Customer Wise') {
                    $('#coupan-wise').show();
                } else if (optionValue == 'Normal') {
                    $('#coupan-wise').hide();
                }
            });
        }).change();
    });
</script>

<script>
    $(document).ready(function() {
        $(document).on('change', "#select2pr", function() {
            $(this).find("option:selected").each(function() {
                var optionValue = $(this).attr("value");
                var newurl = "{{ url('/admin/fetchcustomer') }}/" + optionValue;
                $.ajax({
                    url: newurl,
                    method: 'get',
                    beforeSend: function() {
                        $('#select2pro').html('<option selected hidden>Fetching.......</option>');
                    },
                    success: function(p) {
                        $("#select2pro").html(p);
                    }
                });
            });
        }).change();
    });
</script>

@endpush