<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>iProxier | Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset("/static/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset("/static/admin-lte/css/AdminLTE.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="{{ asset("/static/admin-lte/css/skins/skin-blue.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="skin-blue layout-top-nav">
    <div class="wrapper">
        <div class="content-wrapper">
            <div class="container">
                <div class="box box-info" style="top: 5em;">
                    <div class="box-header with-border">
                        <h3 class="box-title">Logout</h3>
                    </div>
                    <div class="box-body">
                        <p>Your are logout success. Click <a href="/login"><b>here</b></a> to login again. Redirect to home after <span id="timer">3</span> second(s).</p>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>
        </div>
    </div>

</body>
<!-- jQuery 2.1.4 -->
<script src="{{ asset("/static/jquery/jquery-2.1.4.min.js") }}"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset("/static/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset("/static/admin-lte/js/app.min.js") }}" type="text/javascript"></script>
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
                location.href='/user';
            }
        }, 1000);
    }

    go();
});
</script>
</html>
