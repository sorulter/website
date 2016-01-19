@extends('user.dashboard')

@section('content')
<div class='row'>
  <div class="col-md-12">

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Choose your mobile carrier and net type</h3>
            <div class="box-tools">
            </div>
        </div>
        <!-- /.box-header -->

        <div class="box-body">
            <div class="row">
                <div class="col-sm-4 text-center">
                    <a href="{{route('user/cellular/config', 'cmcc')}}">
                        <img src="/static/images/icon/CMCC.png" alt="control" class="img-responsive">
                        <span><h4>CMNET</h4></span>
                    </a>
                </div>

                <div class="col-sm-4 text-center">
                    <a href="{{route('user/cellular/config', 'telcom')}}">
                        <img src="/static/images/icon/TELCOM.png" alt="control" class="img-responsive">
                        <span><h4>CTNET</h4></span>
                    </a>
                </div>

                <div class="col-sm-4 text-center">
                    <a href="{{route('user/cellular/config', 'unicom')}}">
                        <img src="/static/images/icon/UNICOM.png" alt="control" class="img-responsive">
                        <span><h4>3GNET</h4></span>
                    </a>
                </div>

                <div class="col-sm-4 text-center">
                    <a href="{{route('user/cellular/config', 'cmcc')}}">
                        <img src="/static/images/icon/CMCC.png" alt="control" class="img-responsive">
                        <span><h4>CMWAP</h4></span>
                    </a>
                </div>

                <div class="col-sm-4 text-center">
                    <a href="{{route('user/cellular/config', 'telcom')}}">
                        <img src="/static/images/icon/TELCOM.png" alt="control" class="img-responsive">
                        <span><h4>CTWAP</h4></span>
                    </a>
                </div>

                <div class="col-sm-4 text-center">
                    <a href="{{route('user/cellular/config', 'unicom')}}">
                        <img src="/static/images/icon/UNICOM.png" alt="control" class="img-responsive">
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
