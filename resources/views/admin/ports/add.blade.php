@extends('admin.dashboard')

@section('content')
<div class='row'>
  <div class="col-md-12">

    <div class="box box-danger">
      <form method="POST">
        {!! csrf_field() !!}
        <div class="box-header">
            <h3 class="box-title">Add ports</h3>
        </div>
        <div class="box-body">

            @if ( !empty(Session::get('msg')) )
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i> Alert!</h4>
                {{Session::get('msg')}}
            </div>
            @endif

            <div class="form-group">
                <label>Node name:</label>
                @if ($errors->has('name'))
                    <span class="label label-danger">{{$errors->first('name')}}</span>
                @endif
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-tag"></i>
                    </div>
                    <input type="text" class="form-control" name="name">
                </div>
                <!-- /.input group -->
            </div>
            <!-- /.form group -->

            <div class="form-group">
                <label>Ports range:</label>
                @if ($errors->has('min'))
                    <span class="label label-danger">{{$errors->first('min')}}</span>
                @endif
                @if ($errors->has('max'))
                    <span class="label label-danger">{{$errors->first('max')}}</span>
                @endif
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-laptop"></i>
                    </div>
                    <input type="text" class="form-control" name="min">
                    <input type="text" class="form-control" name="max">
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
    <!-- /.box -->

  </div>
</div><!-- /.row -->
@endsection
