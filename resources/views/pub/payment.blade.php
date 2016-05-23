@extends('front')

@section('title')
{{ $title or 'iProxier › Info' }}
@stop

@section('content')
            <div class="callout callout-{{ $type }}">
            <h4>{!! $title !!}</h4>
            {!! $content !!}
            <br>
            <a href="{!! $to !!}" class="btn btn-warning" target="_blank" id="to" style="text-decoration: none">去支付宝付款</a>
            <a href="/user" class="btn btn-warning hidden" id="back" style="text-decoration: none">已确认收货，查看流量</a>
            <br>
          </div>
@stop

@section('js')
<script type="text/javascript">
	$('#to').on('click', function() {
		$(this).toggleClass('hidden');
		$('#back').toggleClass('hidden');
	});
</script>
@stop
