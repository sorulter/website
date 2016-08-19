@extends('user.dashboard')

@section('content')
@if ( !empty(Session::get('msg')) )
<div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-warning"></i> {{ trans('settings.tips') }}</h4>
    {!! Session::get('msg') !!}
</div>
@endif

<div class="row">
	<div class="col-md-3">
		@include('user.invitation.nav')
	</div>
	<div class="col-md-9">
		<div class="box">
			<div class="box-header"><h3 class="box-title">{{ $title }}</h3></div>
			<div class="box-body">
			</div>

			<div class="box-footer">
				<div class="input-group input-group-sm">
					<input type="text" class="form-control" value="{{ url('/invitation', $hash) }}">
					<span class="input-group-btn">
						<button type="button" id="copyme" class="btn btn-info btn-flat" data-clipboard-text="{{ url('/invitation', $hash) }}">{{ trans('invitation.copy') }}</button>
					</span>
				</div>
			</div>

		</div>
	</div>
<script src="{{ env('CDN_BASE') }}/static/js/ZeroClipboard.min.js"></script>
<script type="text/javascript">
	var client = new ZeroClipboard(document.getElementById("copyme"));
</script>
</div>
@stop
