<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>@yield('title', "Proxier") </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
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
  <body class="skin-blue @yield('body-class')">
    <div class="main">

      <!-- Header -->
      @include('pub.header')

      <!-- Content. Contains page content -->
      <div class="content">
        @yield('content')

      </div><!-- /.content -->

      <!-- Footer -->
      @include('pub.footer')

    </div><!-- ./main -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="{{ env('CDN_BASE') }}/static/jquery/jquery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ env('CDN_BASE') }}/static/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="{{ env('CDN_BASE') }}/static/admin-lte/js/app.min.js" type="text/javascript"></script>
    @yield('js')
  </body>
</html>
