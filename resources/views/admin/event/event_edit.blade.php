@extends('admin.app')
@section('title')
Dashbard || Edit Event
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
            <form action="{{route('admin.eventUpdate',$edit->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-6">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{$edit->title ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="meta_tag" class="form-label">Meta Tag</label>
                                <input type="text" class="form-control" id="meta_tag" name="meta_tag" value="{{$edit->meta_tag ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="meta_name" class="form-label">Meta Name</label>
                                <input type="text" class="form-control" id="meta_name" name="meta_name" value="{{$edit->meta_name ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="meta_keyword" class="form-label">Meta Keyword</label>
                                <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" value="{{$edit->meta_keyword ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="date_time" class="form-label">Date & Time</label>
                                <input type="datetime-local" class="form-control" id="date_time" name="date_time" value="{{$edit->date_time ??''}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-6">
                                <label for="description" class="form-label">Description</label>
                                <textarea type="text" class="form-control" id="editor" name="description" rows="8">{!! $edit->description ?? '' !!}</textarea>
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
                    <th>Meta Tag</th>
                    <th>Meta Name</th>
                    <th>Meta Keyword</th>
                    <th>Date Time</th>
                    <th>Description</th>
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
            ajax: "{!! route('admin.event') !!}",

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
                    data: 'meta_tag',
                    name: 'meta_tag',
                },
                {
                    data: 'meta_name',
                    name: 'meta_name',
                },
                {
                    data: 'meta_keyword',
                    name: 'meta_keyword',
                },
                {
                    data: 'date_time',
                    name: 'date_time',
                },
                {
                    data: 'description',
                    name: 'description',
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