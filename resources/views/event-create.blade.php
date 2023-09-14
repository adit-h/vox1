<!-- Horizontal Form -->
@extends('layout.main')

@section('title', 'Sport Events')

@section('css')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add Event</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form class="form-horizontal" action="{{ route('admin.event.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <label for="inputDate" class="col-sm-2 col-form-label">Event Date (WIP)</label>
                <div class="col-sm-10">
                    <div class="input-group date" id="eventdate" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input @error('inputDate') is-invalid @enderror" id="inputDate" name="inputDate" placeholder="Date" value="{{ old('inputDate') }}" data-target="#eventdate">
                        <div class="input-group-append" data-target="#eventdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    @error('inputDate')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="inputType" class="col-sm-2 col-form-label">Event Type</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('inputType') is-invalid @enderror" id="inputType" name="inputType" placeholder="Type" value="{{ old('inputType') }}">
                    @error('inputType')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="inputName" class="col-sm-2 col-form-label">Event Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('inputName') is-invalid @enderror" id="inputName" name="inputName" placeholder="Name" value="{{ old('inputName') }}">
                    @error('inputName')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="inputOrgId" class="col-sm-2 col-form-label">Organize</label>
                <div class="col-sm-10">
                    @php
                    @endphp
                    {{-- <input type="text" class="form-control @error('inputOrgId') is-invalid @enderror" id="inputOrgId" name="inputOrgId" placeholder="Name" value="{{ old('inputOrgId') }}"> --}}
                    <select class="form-control select2 @error('inputOrgId') is-invalid @enderror" id="inputOrgId" name="inputOrgId" style="width: 100%;">
                        <option value="">Select Organize</option>
                        @foreach ($orgs as $org)
                        <option value="{{ $org->id }}">{{ $org->organizerName }}</option>
                        @endforeach
                    </select>
                    @error('inputOrgId')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('admin.event.index') }}" class="btn btn-default float-right">Cancel</a>
        </div>
        <!-- /.card-footer -->
    </form>
</div>
<!-- /.card -->
@endsection

@section('script')
<script>
    $(function () {
    //$(document).ready(function(){
        //Initialize Select2 Elements
        $('.select2').select2()
        //Date picker
        $('#eventdate').datetimepicker({
            format: 'L'
        });
    });
</script>
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
@endsection
