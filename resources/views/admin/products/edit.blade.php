@extends('admin.dashboard')

@section('content')
<div class='row'>
  <div class="col-md-12">

    <div class="box box-danger">
      <form method="POST" action="../update/{{$product->id}}">
        {!! csrf_field() !!}
        <div class="box-header">
            <h3 class="box-title">Edit product</h3>
        </div>
        <div class="box-body">

            @if ( !empty(Session::get('msg')) )
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i> Alert!</h4>
                {{Session::get('msg')}}
            </div>
            @endif

            <div class="row">
                <div class="form-group col-md-12">
                    <label>Name:</label>
                    @if ($errors->has('name'))
                        <span class="label label-danger">{{$errors->first('name')}}</span>
                    @endif
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-tag"></i>
                        </div>
                        <input type="text" class="form-control" name="name"  value="{{$product->name}}">
                    </div>
                    <!-- /.input group -->
                </div>
                <!-- /.form group -->
            </div>

            <div class="row">
                <div class="form-group col-md-4 col-xs-12">
                    <label>Price:</label>
                    @if ($errors->has('price'))
                        <span class="label label-danger">{{$errors->first('price')}}</span>
                    @endif
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-cny"></i></span>
                        <input type="text" class="form-control" name="price" value="{{(int)$product->price}}">
                        <span class="input-group-addon">.00</span>
                    </div>
                    <!-- /.input group -->
                </div>
                <!-- /.form group -->

                <div class="form-group col-md-4 col-xs-12">
                    <label>Amount:</label>
                    @if ($errors->has('amount'))
                        <span class="label label-danger">{{$errors->first('amount')}}</span>
                    @endif
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-bars"></i></span>
                        <input type="text" class="form-control" name="amount" value="{{$product->amount}}">
                        <span class="input-group-addon">M</span>
                    </div>
                    <!-- /.input group -->
                </div>
                <!-- /.form group -->

                <div class="form-group col-md-4 col-xs-12">
                    <label>Type:</label>
                    @if ($errors->has('type'))
                        <span class="label label-danger">{{$errors->first('type')}}</span>
                    @endif
                    <select class="form-control" name="type">
                        <option value="combo" @if ($product->type=="combo") selected @endif>Combo</option>
                        <option value="forever" @if ($product->type=="forever") selected @endif>Forever</option>
                        <option value="extra" @if ($product->type=="extra") selected @endif>Extra</option>
                    </select>
                    <!-- /.input group -->
                </div>
                <!-- /.form group -->
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <label>Describe:</label>
                    @if ($errors->has('describe'))
                        <span class="label label-danger">{{$errors->first('describe')}}</span>
                    @endif
                    <textarea class="form-control" rows="3" name="describe" placeholder="Enter ...">{{$product->describe}}
                    </textarea>
                </div>
            </div>
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
