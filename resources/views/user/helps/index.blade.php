@extends('user.dashboard')

@section('content')
<div class="box">
    <div class="box-header"><h3 class="box-title">{{ trans("articles.Helps List") }}</h3></div><!-- /.box-header -->
    <div class="box-body no-padding table-responsive">
        <table class="table table-striped table-hover">
            <tbody>
                <tr>
                    <th>{{ trans('articles.Title') }}</th>
                    <th style="max-width: 50px;">{{ trans('articles.Read') }}</th>
                </tr>
                @foreach ($helps as $help)
                <tr>
                    <td><a href="{{ route('user/helps', $help->id) }}"><b>{{$help->title}}</b></a></td>
                    <td><a href="{{ route('user/helps', $help->id) }}" class="btn btn-info">{{ trans('articles.Details') }}</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="box-footer clearfix">
        @include('pagination.large', ['paginator' => $helps])
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->

@stop
