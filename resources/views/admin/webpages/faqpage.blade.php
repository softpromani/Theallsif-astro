@extends('admin.app')
@section('title')
Dashbard || Add faq-Page
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
        <form action="{{route('admin.faqAdd')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-2" hidden>
                        <div class="mb-3">
                            @if (isset($faq))
                            @php
                            $id = Crypt::encrypt($faq->id);
                            @endphp
                            @endif
                            <input type="text" class="form-control" id="faq" name="id" value="{{$id ?? ''}}" />
                        </div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <div class="mb-3">
                            <label for="faq" class="form-label">Question</label>
                            <input type="text" class="form-control" id="faq" name="faq" value="{{$faq->faq ?? ''}}" />
                        </div>
                    </div>
                    <br>
                    <div class="col-md-12 mb-2">
                        <div class="mb-3">
                            <label for="full-editor" class="form-label">Answer</label>
                            <textarea type="text" class="form-control" id="editor" name="answer" rows="4">{{$faq->answer ??''}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">{{isset($faq)? 'Update':'Save'}}</button>
            </div>
        </form>



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
                    <th>Question</th>
                    <th>Answer</th>
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
            ajax: "{!! route('admin.faq') !!}",

            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },

                {
                    data: 'faq',
                    name: 'faq'
                },
                {
                    data: 'answer',
                    name: 'answer'
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
        $('#exampleModal').on('shown.bs.modal', function() {
            $('#select2success').select2({
                dropdownParent: $('#exampleModal')
            });
        });
    });
</script>
@endpush