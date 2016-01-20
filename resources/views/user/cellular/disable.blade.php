@extends('user.dashboard')

@section('content')
<style type="text/css">
.gray {
    -webkit-filter: grayscale(100%);
    -moz-filter: grayscale(100%);
    -ms-filter: grayscale(100%);
    -o-filter: grayscale(100%);

    filter: grayscale(100%);

    filter: gray;
}
</style>
<div class='row'>
  <div class="col-md-12">

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Choose your mobile carrier to disable</h3>
            <div class="box-tools">
                <a href="{{ route('user/cellular') }}" class="label label-success">Enable</a>
            </div>
        </div>
        <!-- /.box-header -->

        <div class="box-body">
            <div class="row">
                <div class="col-sm-4 text-center">
                    <a href="{{route('user/cellular/cancel', 'cmnet')}}" target="_blank">
                        <img src="/static/images/icon/CMCC.png" alt="control" class="img-responsive gray">
                        <span><h4>CMNET</h4></span>
                    </a>
                </div>

                <div class="col-sm-4 text-center">
                    <a href="{{route('user/cellular/cancel', 'ctnet')}}" target="_blank">
                        <img src="/static/images/icon/TELCOM.png" alt="control" class="img-responsive gray">
                        <span><h4>CTNET</h4></span>
                    </a>
                </div>

                <div class="col-sm-4 text-center">
                    <a href="{{route('user/cellular/cancel', '3gnet')}}" target="_blank">
                        <img src="/static/images/icon/UNICOM.png" alt="control" class="img-responsive gray">
                        <span><h4>3GNET</h4></span>
                    </a>
                </div>

                <div class="col-sm-4 text-center">
                    <a href="{{route('user/cellular/cancel', 'cmwap')}}" target="_blank">
                        <img src="/static/images/icon/CMCC.png" alt="control" class="img-responsive gray">
                        <span><h4>CMWAP</h4></span>
                    </a>
                </div>

                <div class="col-sm-4 text-center">
                    <a href="{{route('user/cellular/cancel', 'ctwap')}}" target="_blank">
                        <img src="/static/images/icon/TELCOM.png" alt="control" class="img-responsive gray">
                        <span><h4>CTWAP</h4></span>
                    </a>
                </div>

                <div class="col-sm-4 text-center">
                    <a href="{{route('user/cellular/cancel', 'uninet')}}" target="_blank">
                        <img src="/static/images/icon/UNICOM.png" alt="control" class="img-responsive gray">
                        <span><h4>UNINET</h4></span>
                    </a>
                </div>

            </div>
        </div>
        <!-- /.box-body -->

    </div>

  </div>
</div><!-- /.row -->
@endsection
