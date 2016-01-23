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
            <h3 class="box-title">Send mail to <span class="label label-info">{{$toUser->email}}</span></h3>
            <div class="box-tools">
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="form-group">
                <label>Mail title:</label>
                @if ($errors->has('title'))
                    <span class="label label-danger">{{$errors->first('title')}}</span>
                @endif
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-tag"></i>
                    </div>
                    <input type="text" class="form-control" name="title">
                </div>
                <!-- /.input group -->
            </div>
            <div class="form-group">
                <label>Mail MSG:</label>
                @if ($errors->has('msg'))
                    <span class="label label-danger">{{$errors->first('msg')}}</span>
                @endif
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-tag"></i>
                    </div>
                    <input type="text" class="form-control" name="msg">
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
