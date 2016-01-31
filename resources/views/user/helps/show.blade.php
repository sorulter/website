@extends('user.dashboard')

@section('content')
<!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,700,400&subset=latin,latin-ext' rel='stylesheet' type='text/css'> -->
<link rel="stylesheet" type="text/css" href="{{url('/static/css/article.css')}}">
<div class="box box-widget">
    <div class="box-header with-border">
        <h2 class="box-title">
            <span class="username"><a href="#">{{$help->title}}</a></span>
        </h2>
        <small class="description pull-right">Published at - {{$help->updated_at}}</small>
    </div><!-- /.box-header -->
    <div class="box-body table-responsive typora-export ">
        <div class="article-content">
            {!! App\shortcode($help->content) !!}
        </div>
    </div>
    <div class="box-footer clearfix">
        <a href="{{ route('user/helps', '') }}">Back to List</a>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->

@stop