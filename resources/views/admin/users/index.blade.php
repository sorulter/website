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
                        <th>Node/Port</th>
                        <th>Used(MB)</th>
                        <th>F/C/E(MB)</th>
                        <th>Combo End|Last Login | Conn</th>
                        <th>Actions</th>
                    </tr>
                    @foreach ($users as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{App\id2hash($item->id)}}</td>
                        @if ($item->activate == 1)
                        <td><span class="label label-info">{{$item->port->node_name }}</span><span class="label label-warning">{{$item->port->port }}</span></td>
                        <td>{{number_format($item->flows->used/MB, 2) }}</td>
                        <td>{{number_format($item->flows->forever/MB, 2) }} / {{number_format($item->flows->combo/MB, 2) }} / {{number_format($item->flows->extra/MB, 2)}}</td>
                        @elseif ($item->activate == 0)
                        <td>
                            <a href="{{ route('admin/users/activate', $item->id) }}" class="label label-info">Activate</a>
                        </td>
                        <td>0</td>
                        <td>0</td>
                        @elseif ($item->activate == -1)
                        <td>
                            <span class="label label-danger">Blocked</span>
                        </td>
                        <td>0</td>
                        <td>0</td>
                        @endif
                        <td>@if($item->activate == 1)<span>{{ date('y/m/d', strtotime($item->flows->combo_end_date)) }}</span> | <span title="{{$item->updated_at->format('y/m/d H:i:s')}}">{{$item->updated_at->format('y/m/d')}}</span> | <span title="{{ $item->flows->updated_at->format('y/m/d H:i:s') }}">{{ $item->flows->updated_at->format('y/m/d') }}</span>@else
                            not connected @endif</td>
                        <td>
                            <a href="{{ route('admin/users/sendmail', $item->id) }}" class="label label-success">Mail</a>
                            @if ($item->activate == 1)
                            <a href="{{ route('admin/users/gift', $item->id) }}" class="label label-warning">Gift</a>
                            @endif
                        </td>
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
