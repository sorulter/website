<div class="box box-solid">
	<div class="box-header with-border">
		<h3 class="box-title">{{ trans('settings.menu') }}</h3>
	</div>
	<div class="box-body no-padding">
		<ul class="nav nav-pills nav-stacked">
			<li @if ($act == 'index') class="active" @endif><a href="{{ route('user/settings') }}">{{ trans('settings.profiles') }}</a></li>
			<li @if ($act == 'PAC') class="active" @endif><a href="{{ route('user/settings/pac') }}">{{ trans('settings.pac') }}</a></li>
		</ul>
	</div>
</div>
