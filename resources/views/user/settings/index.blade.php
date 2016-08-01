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
					<tr>
						<td>{{ trans('settings.pac_global') }}</td>
						<td>
							<div class="btn-group pull-right small">
							@if ($pacs->global)
								<a class="btn btn-xs btn-default" href="">{{ trans('settings.auto') }}</a>
								<a class="btn btn-xs btn-success">{{ trans('settings.global') }}</a>
							@else
								<a class="btn btn-xs btn-success">{{ trans('settings.auto') }}</a>
								<a class="btn btn-xs btn-default" href="">{{ trans('settings.global') }}</a>
							@endif
							</div>
						</td>
					</tr>
					</tbody>
				</table>
			</div>

			<div class="box-footer">
			</div>

		</div>
	</div>

</div>
@stop
