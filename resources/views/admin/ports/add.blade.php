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

            <div class="form-group">
                <label>Node name:</label>
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
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-laptop"></i>
                    </div>
                    <input type="text" class="form-control" name="down">
                    <input type="text" class="form-control" name="up">
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
