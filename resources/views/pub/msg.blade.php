@extends('front')

@section('title')
{{ $title or 'iProxier › Info' }}
@stop

@section('content')
            <div class="callout callout-{{ $type }}">
            <h4>{!! $title !!}</h4>
            {!! $content !!}
          </div>

@stop
