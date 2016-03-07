@extends('user.dashboard')

@section('content')
<div class="box">
    <div class="box-header"><h3 class="box-title">{{ trans("logs.title") }}</h3></div><!-- /.box-header -->
    <div class="box-body no-padding table-responsive">
        <table class="table table-striped table-hover">
            <tbody>
                <tr>
                    <th>{{ trans('logs.flows')/MB }}</th>
                    <th>{{ trans('logs.ip') }}</th>
                    <th>{{ trans("logs.time") }}</th>
                </tr>
                @foreach ($logs as $log)
                <tr>
                    <td>{{$log->flows}}</td>
                    <td>{{long2ip($log->client_ip)}}</td>
                    <td>{{$log->used_at}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="box-footer clearfix">
        @include('pagination.large', ['paginator' => $logs])
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->

@stop
