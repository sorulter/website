@extends('admin.dashboard')

@section('content')
<style type="text/css">
.cut {
    white-space: nowrap;
      width: 15em;
      overflow: hidden;display: -webkit-box;
      text-overflow: ellipsis;
}
</style>
<div class='row'>
  <div class="col-md-12">
            @if ( !empty(Session::get('msg')) )
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <b>{{Session::get('msg')}}</b>
            </div>
            @endif

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Tracks List({{$tracks->total()}})</h3>
            <div class="box-tools">
                <a href="{{route('admin/tracks')}}"><span class="label label-success">All</span></a>

            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover table-striped">
                <tbody>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Type</th>
                        <th style="min-width: 40px">Source</th>
                        <th>IP</th>
                        <th>Referrer</th>
                        <th>Status</th>
                        <th>Count</th>
                        <th>Created</th>
                        <th>Updated</th>
                    </tr>
                    @foreach ($tracks as $track)
                    <tr>
                        <td>{{$track->id}}</td>
                        <td>{{$track->type}}</td>
                        <td>{{$track->source}}</td>
                        <?php $record = QQWry::query($track->ip);?>
                        <td>{{$track->ip}}({{$record['country']}})</td>
                        <td><span class="cut">{{$track->referrer}}</span></td>
                        <td>{{$track->status}}</td>
                        <td>{{$track->count}}</td>
                        <td>{{$track->created_at}}</td>
                        <td>{{$track->updated_at}}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
        	@include('pagination.large', ['paginator' => $tracks])
        </div>
    </div>

  </div>
</div><!-- /.row -->
@endsection
