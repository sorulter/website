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
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

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

      <form method="post">

        <label class="control-label" for="username" style="display: none;">
          <i class="fa fa-times-circle-o"></i>
          <span>Username length must between 4 and 20.</span>
        </label>
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Username" name="username" id="username">
          <span class="input-group-addon">
            <i class="glyphicon glyphicon-user"></i>
          </span>
        </div>
        <br>

        <label class="control-label" for="email" style="display: none;">
          <i class="fa fa-times-circle-o"></i>
          <span>Invalid email address.</span>
        </label>
        <div class="input-group">
          <input type="email" class="form-control" placeholder="Email" name="email" id="email">
          <span class="input-group-addon">
            <i class="glyphicon glyphicon-envelope"></i>
          </span>
        </div>
        <br>

        <label class="control-label" for="password" style="display: none;">
          <i class="fa fa-times-circle-o"></i>
          <span>Password length must between 6 and 20.</span>
        </label>
        <div class="input-group">
          <input type="password" class="form-control" placeholder="Password" name="password" id="password">
          <span class="input-group-addon">
            <i class="glyphicon glyphicon-lock"></i>
          </span>
        </div>
        <br>

        <label class="control-label" for="re-password" style="display: none;">
          <i class="fa fa-times-circle-o"></i>
          <span>Not equal first typed.</span>
        </label>
        <div class="input-group">
          <input type="password" class="form-control" placeholder="Retype password" id="re-password">
          <span class="input-group-addon">
            <i class="glyphicon glyphicon-log-in"></i>
          </span>
        </div>
        <br>

        <div class="form-group">
          <span class="glyphicon glyphicon-alert"></span>
          <b>Register account,and I agree to the <a href="#">terms</a></b>
        </div>
        <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
      </form>
    </div>

    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->


  <!-- jQuery 2.1.4 -->
  <script src="{{ asset("/static/jquery/jquery-2.1.4.min.js") }}"></script>
  <!-- Bootstrap 3.3.2 JS -->
  <script src="{{ asset("/static/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>
  <script>
  function valid_email(email) {
    var patten = new RegExp(/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]+$/);
    return patten.test(email);
  }

  function showErrorMsg(element) {
    $('label[for='+element.id+']').css('display', 'block');
    $(element).parent().removeClass('has-feedback').addClass('has-error');
  }

  function hideErrorMsg(element) {
    $('label[for='+element.id+']').css('display', 'none');
    $(element).parent().removeClass('has-error').addClass('has-success');
  }

  jQuery.fn.shake = function(intShakes, intDistance, intDuration) {
    this.each(function() {
      $(this).css("position","relative");
      for (var x=1; x<=intShakes; x++) {
        $(this).animate({left:(intDistance*-1)}, (((intDuration/intShakes)/4)))
        .animate({left:intDistance}, ((intDuration/intShakes)/2))
        .animate({left:0}, (((intDuration/intShakes)/4)));
      }
    });
    return this;
  };

  </script>
  </body>
</html>
