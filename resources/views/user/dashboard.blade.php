<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>{{ $page_title or "iProxier Dashboard" }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="icon" type="image/png" href="{{ env('CDN_BASE') }}/static/images/icon/logo.png">
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ env('CDN_BASE') }}/static/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ env('CDN_BASE') }}/static/admin-lte/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ env('CDN_BASE') }}/static/admin-lte/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />
    @include('pub.apple')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue">
    <div class="wrapper">

      <!-- Header -->
      @include('user.header')

      <!-- Sidebar -->
      @include('user.sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content header -->
        <section class="content-header">
            <h1>@if (isset($title)) {{$title}} @endif
            <small>@if (isset($subtitle)) {{$subtitle}} @endif</small></h1>
        </section>

        <!-- Main content -->
        <section class="content">
          @yield('content')
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Footer -->
      @include('user.footer')

    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="{{ env('CDN_BASE') }}/static/jquery/jquery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ env('CDN_BASE') }}/static/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="{{ env('CDN_BASE') }}/static/admin-lte/js/app.min.js" type="text/javascript"></script>
    <script type="text/javascript">
    var path = window.location.pathname;

    if (path == "/user") {
      $('#user-services').addClass('active');
    };
    if (path == "/user/billing") {
      $('#user-billing').addClass('active');
    };
    if (path == "/user/helps") {
      $('#user-helps').addClass('active');
    };
    if (path == "/user/logs") {
      $('#user-logs').addClass('active');
    };
    if (path == "/user/settings") {
      $('#user-settings').addClass('active');
    };
    if (path == "/user/invitation") {
      $('#user-invitation').addClass('active');
    };

    </script>
    @yield('script')

  </body>
</html>
