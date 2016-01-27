@extends('admin.dashboard')

@section('content')
<div class='row'>
  <div class="col-md-12">

    <div class="box">
        <form action="store" method="POST">
            {!! csrf_field() !!}
            <div class="box-header with-border">
                <h3 class="box-title">New Article</h3>
                <div class="box-tools">
                </div>
            </div>
            @if ($errors->has('category_id') or $errors->has('status'))
                <div class="alert alert-danger">
                    <ul>
                        @if ($errors->has('category_id'))
                            <li>{{ $errors->first('category_id') }}</li>
                        @endif

                        @if ($errors->has('status'))
                            <li>{{ $errors->first('status') }}</li>
                        @endif
                    </ul>
                </div>
            @endif

            <!-- /.box-header -->
            <div class="box-body">

                @if ( !empty(Session::get('msg')) )
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-info"></i> Alert!</h4>
                    {{Session::get('msg')}}
                </div>
                @endif

                <div class="form-group col-xs-12">
                    <label>Title:</label>
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
                <!-- /.form group -->

                <div class="form-group col-xs-6">
                    <label>Category:</label>
                    <select class="form-control select2" name="category_id">
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->title}}</option>
                        @endforeach
                    </select>
                </div>
                <!-- /.form group -->

                <div class="form-group col-xs-6">
                    <label>Status:</label>
                    <select class="form-control select2" name="status">
                        <option value="0">Draft</option>
                        <option value="1">Publish</option>
                    </select>
                </div>
                <!-- /.form group -->

                <div class="form-group col-xs-12">
                    <label>Content:</label>
                    @if ($errors->has('content'))
                        <span class="label label-danger">{{$errors->first('content')}}</span>
                    @endif
                    <textarea class="form-control" rows="3" placeholder="Enter ..." name="content"></textarea>
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
