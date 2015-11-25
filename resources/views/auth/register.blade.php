<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>iProxier | Register</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset("/static/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset("/static/admin-lte/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
<body class="hold-transition login-page" style="background: url(http://ww3.sinaimg.cn/large/6816152bgw1exn0b9uqbgj21kw1230un.jpg) no-repeat center center fixed;">
  <div class="login-box">
    <div class="login-logo">
      <a href="{{ url('/') }}"><b>iProxier</b>.com</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Register your account.</p>

      <form method="post" action="/auth/register">
        {!! csrf_field() !!}

        <label class="control-label text-red" for="email" style="display: @if ($errors->default->has('email'))block @else none @endif;">
          <i class="fa fa-times-circle-o"></i>
          <span>{{ $errors->default->first('email') }}</span>
        </label>
        <div class="input-group @if ($errors->register->has('email')) has-error @endif">
          <input type="email" class="form-control" placeholder="Email" name="email" id="email" value="{{ old('email') }}">
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
          <input type="password" class="form-control" placeholder="Password" name="password" id="password">
          <span class="input-group-addon">
            <i class="glyphicon glyphicon-lock"></i>
          </span>
        </div>
        <br>

        <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
      </form>
    </div>

    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

  </body>
</html>
