@extends('admin.app')
@section('title')
Dashbard || Edit Socials
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
</div>

@foreach ($data as $key=>$d)
<form action="{{route('admin.sociallinkStore')}}" method="post">
    <input type="hidden" name="type" value="{{$key}}">
    @csrf
    <div class="card mt-3">
        <div class="card-header">
            <div class="card-title">{{strtoupper($key)}} Setting</div>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($d as $field)
                <div class="col-md-6 col-sm-12 mt-3">
                    <label class="form-label" for="{{$field->key}}">{{$field->key}}</label>
                    <input type="text" name="{{$field->key}}" id="{{$field->key}}" class="form-control" value="{{$field->value}}">
                </div>
                @endforeach
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary">Update Setting</button>
        </div>
    </div>
</form>
@endforeach
@endsection
@push('scripts')

@endpush