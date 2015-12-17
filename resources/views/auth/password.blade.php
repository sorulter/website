@extends('front')

@section('body-class') hold-transition login-page @stop

@section('title')
iProxier › Reset your password via email
@stop


@section('content')
  <div class="login-box">
    <div class="login-box-body">
      <p class="login-box-msg">Reset your password via email</p>

      <form method="POST" action="/forgot">
        {!! csrf_field() !!}

        <label class="control-label text-red" for="email" style="display: @if ($errors->default->has('email'))block @else none @endif;">
          <i class="fa fa-times-circle-o"></i>
          <span>{{ $errors->default->first('email') }}</span>
        </label>
        <div class="input-group @if ($errors->default->has('email')) has-error @endif">
          <input type="email" class="form-control" placeholder="Email" name="email" id="email" value="{{ old('email') }}">
          <span class="input-group-addon">
            <i class="glyphicon glyphicon-envelope"></i>
          </span>
        </div>
        <br>

        <label class="control-label text-red" for="captcha" style="display: @if ($errors->default->has('captcha'))block @else none @endif;">
          <i class="fa fa-times-circle-o"></i>
          <span>{{ $errors->default->first('captcha') }}</span>
        </label>
        <div class="col-xs-5" style="padding-left: 0;">{!! captcha_img() !!}</div>
        <div class="col-xs-7 input-group @if ($errors->default->has('captcha')) has-error @endif">
          <input type="text" class="form-control" placeholder="Captcha" name="captcha" id="captcha">
          <span class="input-group-addon">
            <i class="glyphicon glyphicon-user"></i>
          </span>
        </div>
        <br>

        <div class="row">
          <div class="col-xs-12">
            <button type="submit" class="btn btn-primary btn-block btn-float">Send Password Reset Link</button>
          </div>
          <!-- /.col -->
        </div>

      </form>

    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->
@stop
