@extends('admin.dashboard')

@section('content')
<div class='row'>
  <div class="col-md-12">
            @if ( !empty(Session::get('msg')) )
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <b>{{Session::get('msg')}}</b>
            </div>
            @endif

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Products List({{$products->total()}})</h3>
            <div class="box-tools">
                <a href="{{route('admin/products')}}"><span class="label label-success">All</span></a>

                <a href="{{route('admin/products/create')}}"><span class="label label-info">Create</span></a>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover table-striped">
                <tbody>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th style="min-width: 40px">Price</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Actions</th>
                    </tr>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->created_at}}</td>
                        <td>{{$product->updated_at}}</td>
                        <td>
                            <a href="products/edit/{{$product->id}}"><label class="label label-success">Edit</label></a>
                            @if($product->trashed())
                            <a href="products/restore/{{$product->id}}"><label class="label label-info">Restore</label></a>
                            @else
                            <a href="products/destroy/{{$product->id}}"><label class="label label-warning">Destroy</label></a>
                            @endif
                            <a href="products/delete/{{$product->id}}"><label class="label label-danger">Delete</label></a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
        	@include('pagination.large', ['paginator' => $products])
        </div>
    </div>

  </div>
</div><!-- /.row -->
@endsection
