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
        <div class="box-body">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Email</th>
                        <th>Hash ID</th>
                        <th>Activate</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Actions</th>
                    </tr>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{App\id2hash($user->id)}}</td>
                        <td>{{$user->activate}}</td>
                        <td>{{$user->created_at}}</td>
                        <td>{{$user->updated_at}}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
        	@include('pagination.large', ['paginator' => $users])
        </div>
    </div>

  </div>
</div><!-- /.row -->
@endsection
