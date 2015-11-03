<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>iProxier | Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset("/static/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset("/static/admin-lte/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <!-- <link href="{{ asset("/static/admin-lte/css/skins/skin-blue.min.css")}}" rel="stylesheet" type="text/css" /> -->
    <link rel="stylesheet" href="{{ asset("/static/plugins/iCheck/square/blue.css") }}">

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
      <p class="login-box-msg">Sign in to start your session</p>
      <div class="alert alert-success alert-dismissable" style="display: none;" id="msg-success">
        <button type="button" class="close" aria-hidden="true">×</button>
        <p>...</p>
      </div>
      <div class="alert alert-danger alert-dismissable" style="display: none;" id="msg-error">
        <button type="button" class="close" aria-hidden="true">×</button>
        <p>...</p>
      </div>

      <form>
        <div class="form-group has-feedback">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="text" class="form-control" placeholder="Username" name="username" id="username">
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Password" name="password" id="password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
      </form>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" id="submit" disabled>Sign In</button>
        </div>
        <!-- /.col -->
      </div>

      <a href="#">I forgot my password</a>&emsp;|&emsp;<a href="#" class="text-center">Register a new membership</a>

    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->


  <!-- jQuery 2.1.4 -->
  <script src="{{ asset("/static/jquery/jquery-2.1.4.min.js") }}"></script>
  <!-- Bootstrap 3.3.2 JS -->
  <script src="{{ asset("/static/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset("/static/admin-lte/js/app.min.js") }}" type="text/javascript"></script>
  <!-- iCheck -->
  <script src="{{ asset("/static/plugins/iCheck/icheck.min.js") }}"></script>
  <script>
    $(function () {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      });

      // chekc input value
      $('#username').keyup(function() {
          if ($(this).val() && $('#password').val()) {
              $('#submit').attr('disabled', false);
          } else {
              $('#submit').attr('disabled', true);
          };
      });
      $('#password').keyup(function() {
          if ($(this).val() && $('#username').val()) {
              $('#submit').attr('disabled', false);
          } else {
              $('#submit').attr('disabled', true);
          };
      });

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      var login = function() {
        $.ajax({
          type:"POST",
          url:"{{ route('user/login') }}",
          dataType:"json",
          data:{
            username: $("#username").val(),
            password: $("#password").val(),
            remember: $("#remember").val()
          },
          success:function(data){
            if(data.ok){
              $("#msg-error").hide(100);
              $("#msg-success").show(100);
              $("#msg-success p").html(data.msg);
              window.setTimeout("location.href='{{ url('user') }}'", 2000);
            }else{
              $("#msg-error").hide(10);
              $("#msg-error").show(100);
              $("#msg-error p").html(data.msg);
            }
          },
          error:function(jqXHR){
            $("#msg-error").hide(10);
            $("#msg-error").show(100);
            $("#msg-error p").html("Error:"+jqXHR.status);
          }
        });
      }
      $(".close").click(function(){
        $(".alert").hide(100);
      });

      // login
      $('#submit').click(function(e) {
        login();
      });
      $("html").keydown(function(event){
        if(event.keyCode==13){
          login();
        }
      });

    });
  </script>
  </body>
</html>
