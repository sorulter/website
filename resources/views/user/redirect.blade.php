<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>{{ $title or "iProxier redirect page." }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset("/static/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset("/static/admin-lte/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("/static/admin-lte/css/skins/skin-blue.min.css")}}" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue layout-top-nav">
    <div class="wrapper">

      <!-- Header -->
      @include('user.header')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

        <section class="content">
          <div class="callout callout-{{ $type }}">
            <h4>{!! $title !!}</h4>
            <p>{!! $content !!}</p>
            <p>Redirect to <a href="{{ $to }}">{{ $to }}</a> after <span id="timer">{{ $time }}</span> second(s).</p>
          </div>
        </section>

      </div><!-- /.content-wrapper -->

      <!-- Footer -->
      @include('user.footer')

    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="{{ asset ("/static/jquery/jquery-2.1.4.min.js") }}"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ asset ("/static/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset ("/static/admin-lte/js/app.min.js") }}" type="text/javascript"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        var timer = $('#timer').text();
        function go() {
            console.log("go");
            window.setTimeout(function() {
                timer--;
                if(timer > 0) {
                    $('#timer').text(timer);
                    go();
                } else {
                    location.href='{{ $to }}';
                }
            }, 1000);
        }

        go();
    });
    </script>
  </body>
</html>