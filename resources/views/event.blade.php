@extends('layout.main')

@section('title', 'Sport Events')

@section('content')
<section class="content">
    <div class="container-fluid">
        <!-- boxes (Stat box) -->
        <!-- Default box -->
        @if($msg = Session::get('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ $msg }}
        </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Event List</h3>

                <div class="card-tools">
                    <a class="btn btn-primary btn-sm mr-3" href="{{ route('admin.event.create') }}">
                        <i class="fas fa-plus"></i>
                        Insert
                    </a>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <!-- <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button> -->
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 1%">
                                #
                            </th>
                            <th style="width: 15%">
                                Event Date
                            </th>
                            <th style="width: 15%">
                                Event Name
                            </th>
                            <th style="width: 15%">
                                Event Type
                            </th>
                            <th style="width: 15%">
                                Image Location
                            </th>
                            <th style="width: 15%">
                                Organizer Name
                            </th>

                            <th style="width: 20%" class="text-center">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($datas) && count($datas)>0)
                        @foreach ($datas as $event)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                <a>{{ $event->eventDate }}</a>
                            </td>
                            <td>
                                <a>{{ $event->eventName }}</a>
                            </td>
                            <td>
                                <a>{{ $event->eventType }}</a>
                            </td>
                            <td>
                                <a>{{ $event->organizer->imageLocation }}</a>
                            </td>
                            <td>
                                <a>{{ $event->organizer->organizerName }}</a>
                            </td>
                            <td class="project-actions text-center">
                                <a class="btn btn-info btn-sm" href="{{ route('admin.event.edit', ['id' => $event->id]) }}">
                                    <i class="fas fa-pencil-alt"></i>
                                    Edit
                                </a>
                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete-{{ $event->id }}" href="#">
                                    <i class="fas fa-trash"></i>
                                    Delete
                                </a>
                            </td>
                        </tr>
                        <div class="modal fade" id="modal-delete-{{ $event->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Confirm Delete</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure to delete eventDate <strong>{{ $event->eventName }}</strong> ?</p>
                                    </div>
                                    <div class="modal-footer justify-content">
                                        <form action="{{ route('admin.event.delete', ['id' => $event->id]) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Yes</button>
                                        </form>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                        @endforeach
                        @else
                        <tr>
                            <td colspan="3">No Data Available</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer mt-3">
                {{ $page->links() }}
            </div>
        </div>
        <!-- /.card -->
        <!-- /.box -->
    </div><!-- /.container-fluid -->
</section>
@endsection
