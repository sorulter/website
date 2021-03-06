@extends('front')

@section('body-class') hold-transition login-page @stop
@section('title')
iProxier › {{ trans('base.login') }}
@stop

@section('content')
<!-- iCheck -->
<link rel="stylesheet" href="{{env('CDN_BASE')}}/static/plugins/iCheck/square/blue.css">
  <div class="login-box">
    <div class="login-box-body">
      <p class="login-box-msg">{{ trans('base.login_subtitle') }}</p>

      <form method="post" action="/login">
        {!! csrf_field() !!}

        <label class="control-label text-red" for="email" style="display: @if ($errors->default->has('email'))block @else none @endif;">
          <i class="fa fa-times-circle-o"></i>
          <span>{{ $errors->default->first('email') }}</span>
        </label>
        <div class="form-group has-feedback @if ($errors->default->has('email')) has-error @endif">
          <input type="text" class="form-control" placeholder="{{ trans('base.email') }}" name="email" id="email" value="{{ old('email') }}">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="{{ trans('base.password') }}" name="password" id="password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-8">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox" name="rememberme" id="rememberme"> {{ trans('base.rememberme') }}
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('base.signin') }}</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <a href="/forgot">{{ trans('base.forget_password') }}</a>&emsp;|&emsp;<a href="/register" class="text-center">{{ trans('base.regsiter_account') }}</a>

    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->
@stop

@section('js')
<!-- iCheck -->
<script src="{{env('CDN_BASE')}}/static/plugins/iCheck/icheck.min.js"></script>

  <script type="text/javascript">
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
  </script>
@stop
