@extends('user.dashboard')

@section('content')
<div class='row'>
  <div class="col-md-12">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Status</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row" id="overlay">
                <p class="text-center" style="font-size: 3em;"><i class="fa fa-spinner fa-spin"></i><b>Checking...</b></p>
            </div>
            <div class="row hidden" id="status">
                <div class="col-xs-6">
                    <div class="input-group">
                        <input class="form-control" value="PAC Server status" style="font-weight: bolder;" readonly>
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-danger" id="pac-status-danger"><i class="fa fa-times-circle"></i></button>
                            <button type="button" class="btn btn-success hidden" id="pac-status-success"><i class="fa fa-check-circle"></i></button>
                        </div>
                    </div>
                </div>

                <div class="col-xs-6">
                    <div class="input-group">
                        <input class="form-control" value="Proxy Server status" style="font-weight: bolder;" readonly>
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-danger" id="proxy-status-danger"><i class="fa fa-times-circle"></i></button>
                            <button type="button" class="btn btn-success hidden" id="proxy-status-success"><i class="fa fa-check-circle"></i></button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.box-body -->

        <div class="box-footer no-padding" style="display: block;">
        </div>
        <!-- /.footer -->
    </div>

  </div>
</div><!-- /.row -->
@endsection

@section('script')
<script type="text/javascript">
$(function() {

    var pac = '{{env('PAC_PING_URL')}}';
    $.get(pac).success(function(data){
        $('#pac-status-danger').toggleClass('hidden');
        $('#pac-status-success').toggleClass('hidden');
    });
    var proxy = 'https://{{$user->port->node_name}}.{{env('NODE_BASE_NAME')}}:{{env('PING_PORT')}}/ping';
    $.get(proxy).success(function(data){
        $('#proxy-status-danger').toggleClass('hidden');
        $('#proxy-status-success').toggleClass('hidden');
    });

    setTimeout(function() {
        $('#overlay').toggleClass('hidden');
        $('#status').toggleClass('hidden');
    }, 1500);

});
</script>
@endsection
