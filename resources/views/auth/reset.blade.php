@extends('front')

@section('body-class') hold-transition login-page @stop

@section('title')
iProxier › {{ trans('base.reset_password') }}
@stop

@section('content')
  <div class="login-box">
    <div class="login-box-body">
      <p class="login-box-msg">{{ trans('base.reset_password') }}</p>

      <form method="POST" action="/reset">
        {!! csrf_field() !!}

        <input type="hidden" name="token" value="{{ $token }}">

        <label class="control-label text-red" for="email" style="display: @if ($errors->default->has('email'))block @else none @endif;">
          <i class="fa fa-times-circle-o"></i>
          <span>{{ $errors->default->first('email') }}</span>
        </label>
        <div class="input-group @if ($errors->default->has('email')) has-error @endif">
          <input type="email" class="form-control" placeholder="{{ trans('base.email') }}" name="email" id="email" value="{{ old('email') }}">
          <span class="input-group-addon">
            <i class="glyphicon glyphicon-envelope"></i>
          </span>
        </div>
        <br>

        <label class="control-label text-red" for="password" style="display: @if ($errors->default->has('password'))block @else none @endif;">
          <i class="fa fa-times-circle-o"></i>
          <span>{{ $errors->default->first('password') }}</span>
        </label>
        <div class="input-group">
          <input type="password" class="form-control" placeholder="{{ trans('base.password') }}" name="password" id="password">
          <span class="input-group-addon">
            <i class="glyphicon glyphicon-lock"></i>
          </span>
        </div>
        <br>

        <label class="control-label text-red" for="password_confirmation" style="display: @if ($errors->default->has('password_confirmation'))block @else none @endif;">
          <i class="fa fa-times-circle-o"></i>
          <span>{{ $errors->default->first('password_confirmation') }}</span>
        </label>
        <div class="input-group">
          <input type="password" class="form-control" placeholder="{{ trans('base.password_confirmation') }}" name="password_confirmation" id="password_confirmation">
          <span class="input-group-addon">
            <i class="glyphicon glyphicon-lock"></i>
          </span>
        </div>
        <br>

        <div class="row">
          <div class="col-xs-12">
            <button type="submit" class="btn btn-primary btn-block btn-float">{{ trans('base.submit') }}</button>
          </div>
          <!-- /.col -->
        </div>

      </form>

    </div>
    <!-- /.reset-box-body -->
  </div>
  <!-- /.reset-box -->
@stop
