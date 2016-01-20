@extends('admin.dashboard')

@section('content')
<div class='row'>
  <div class="col-md-12">

    @if ( !empty(Session::get('msg')) )
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-warning"></i> Alert!</h4>
        {{Session::get('msg')}}
    </div>
    @endif

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Users List</h3>
            <div class="box-tools">
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover table-striped">
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
                        <td><a href="{{ route('admin/users/activate', $user->id) }}" class="label label-info">Activate</a></td>
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
