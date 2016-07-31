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
		@include('user.settings.nav')
	</div>
	<div class="col-md-9">
		<div class="box">
			<div class="box-header"><h3 class="box-title">{{ $title }}</h3></div>
			<div class="box-body no-padding table-responsive">
				<table class="table table-hover table-striped">
					<tbody>
					@foreach ($items as $k=>$v)
					@if ($v)
						<tr>
							<td class="col-md-9">
								<b>{{ $k }}</b>
							</td>
							<td class="col-md-3 small">
								<a class="bg-red remove pull-right" href="/user/settings/pac/remove/{{ mb_substr(md5($k+env('APP_KEY')), 8, 16) }}">
								{{ trans('settings.remove') }}
								</a>
							</td>
						</tr>
					@endif
					@endforeach
					</tbody>
				</table>
			</div>

			<div class="box-footer">
				<form method="post" action="">
							{!! csrf_field() !!}
							<div class="input-group">
								<input name="domain" type="text" class="form-control" placeholder="{{ trans('settings.input_url') }}">
								<div class="input-group-btn">
									<button id="add-new-pac" type="submit" class="btn btn-primary btn-flat">{{ trans('settings.add') }}</button>
								</div>
							</div>
				</form>
			</div>

		</div>
	</div>

</div>
<style type="text/css">
	.remove {
		padding: 3px 10px;
		font-weight: bold;
		margin-right: 3px;
		box-shadow: 0 1px 1px rgba(0,0,0,0.1);
		text-shadow: 0 1px 1px rgba(0,0,0,0.1);
	}
</style>
@stop
