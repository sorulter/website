@extends('user.dashboard')

@section('content')
<div class='row'>
  <div class="col-md-12">
    <div class="col-md-6">

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Free to Try</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <p> Welcome to use IPX(iPorxier).There is the guide for you.</p>
            </div>
            <!-- /.box-body -->

            <div class="box-footer no-padding" style="display: block;">
            </div>
            <!-- /.footer -->
        </div>

    </div>

    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">How to Configure</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-4 text-center">
                        <a href="">
                            <img src="/static/images/icon/ios.png" alt="ios">
                            <span><h4>ios</h4></span>
                        </a>
                    </div>

                    <div class="col-xs-4 text-center">
                        <a href="">
                            <img src="/static/images/icon/android.png" alt="android">
                            <span><h4>android</h4></span>
                        </a>
                    </div>

                    <div class="col-xs-4 text-center">
                        <a href="">
                            <img src="/static/images/icon/mac.png" alt="mac">
                            <span><h4>mac</h4></span>
                        </a>
                    </div>

                    <div class="col-xs-4 text-center">
                        <a href="">
                            <img src="/static/images/icon/windows.png" alt="windows">
                            <span><h4>windows</h4></span>
                        </a>
                    </div>

                    <div class="col-xs-4 text-center">
                        <a href="">
                            <img src="/static/images/icon/control.png" alt="control">
                            <span><h4>control</h4></span>
                        </a>
                    </div>

                    <div class="col-xs-4 text-center">
                        <a href="">
                            <img src="/static/images/icon/more.png" alt="more">
                            <span><h4>more</h4></span>
                        </a>
                    </div>

                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer no-padding" style="display: block;">
            </div>
            <!-- /.footer -->
        </div>
    </div>

  </div>
</div><!-- /.row -->
@endsection
