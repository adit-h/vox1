<!-- Horizontal Form -->
@extends('layout.main')

@section('title', 'Organizer')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add Organizer</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form class="form-horizontal" action="{{ route('admin.organizer.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <label for="inputOrganizer" class="col-sm-2 col-form-label">Organizer Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('inputOrganizer') is-invalid @enderror" id="inputOrganizer" name="inputOrganizer" placeholder="Name" value="{{ old('inputOrganizer') }}">
                    @error('inputOrganizer')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="inputLocation" class="col-sm-2 col-form-label">Image Location</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('inputLocation') is-invalid @enderror" id="inputLocation" name="inputLocation" placeholder="Location" value="{{ old('inputLocation') }}">
                    @error('inputLocation')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('admin.organizer.index') }}" class="btn btn-default float-right">Cancel</a>
        </div>
        <!-- /.card-footer -->
    </form>
</div>
<!-- /.card -->
@endsection
