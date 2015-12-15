@extends('front')

@section('content')
            <div class="callout callout-{{ $type }}">
            <h4>{!! $title !!}</h4>
            {!! $content !!}
          </div>

@stop
