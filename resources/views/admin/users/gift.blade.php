@extends('admin.dashboard')

@section('content')
<div class='row'>
  <div class="col-md-12">

    @if ( !empty(Session::get('msg')) )
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-warning"></i> Alert!</h4>
        {{Session::get('msg')}}
    </div>
    @endif

    <div class="box">
        <form method="POST">
        {!! csrf_field() !!}

        <div class="box-header with-border">
            <h3 class="box-title">Gift to <span class="label label-info">{{$toUser->email}}</span></h3>
            <div class="box-tools">
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="form-group">
                <label>Give:</label>
                @if ($errors->has('flows'))
                    <span class="label label-danger">{{$errors->first('flows')}}</span>
                @endif
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-gift"></i>
                    </div>
                    <input type="text" class="form-control" name="flows">
                    <span class="input-group-addon">MB</span>
                </div>
                <!-- /.input group -->
            </div>
            <!-- /.form group -->

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-danger pull-right">Submit</button>
        </div>

        </form>
    </div>

  </div>
</div><!-- /.row -->
@endsection
