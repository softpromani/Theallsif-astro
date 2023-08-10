@extends('admin.app')
@section('title')
Dashbard || Edit Web Sliders
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
            <form action="{{route('admin.webSliderUpdate',$edit->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-6">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{$edit->title ?? ''}}">
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


    <div class="card-datatable table-responsive">
        <table class="datatables table border-top">
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Is Active</th>
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
            ajax: "{!! route('admin.webSlider') !!}",

            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'imagemedia',
                    name: 'imagemedia   '
                },
                {
                    data: 'title',
                    name: 'title',
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

                // Add more column definitions here
            ]
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(document).on('change', '.is_active', function() {
            var statusId = $(this).data('id');
            var isActive = $(this).is(':checked');
            var newurl = "{{ url('/admin/event-status') }}/" + statusId;
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
@endpush