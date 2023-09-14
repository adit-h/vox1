@extends('layout.main')

@section('title', 'Dashboard')

@section('content')
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        @if($msg = Session::get('failed'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ $msg }}
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12 col-12">
                <h1>Welcome</h1>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection
