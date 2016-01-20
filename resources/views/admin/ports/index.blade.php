@extends('admin.dashboard')

@section('content')
<div class='row'>
  <div class="col-md-12">

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Ports List</h3>
            <div class="box-tools">
                <a href="{{route('admin/ports')}}"><span class="label label-success">All</span></a>
                <a href="{{route('admin/ports/index/used')}}"><span class="label label-success">Used</span></a>
                <a href="{{route('admin/ports/index/empty')}}"><span class="label label-success">Empty</span></a>

                <a href="{{route('admin/ports/add')}}"><span class="label label-info">Add Ports</span></a>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover table-striped">
                <tbody>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Node Name</th>
                        <th style="min-width: 40px">Port</th>
                        <th>User ID</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Actions</th>
                    </tr>
                    @foreach ($ports as $port)
                    <tr>
                        <td>{{$port->id}}</td>
                        <td>{{$port->node_name}}</td>
                        <td>{{$port->port}}</td>
                        <td><span class="badge @if ($port->user_id!=0) bg-red @else bg-green @endif ">{{$port->user_id}}</span></td>
                        <td>{{$port->created_at}}</td>
                        <td>{{$port->updated_at}}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
        @if ($ports->hasMorePages())
        <div class="box-footer clearfix">
        	@include('pagination.large', ['paginator' => $ports])
        </div>
        @endif
    </div>

  </div>
</div><!-- /.row -->
@endsection
