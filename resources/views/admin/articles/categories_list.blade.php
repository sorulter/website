@extends('admin.dashboard')

@section('content')
<div class='row'>
  <div class="col-md-12">

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Categories List({{$categories->total()}})</h3>
            <div class="box-tools">
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover table-striped">
                <tbody>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Link Name</th>
                        <th style="min-width: 40px">Category</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Actions</th>
                    </tr>
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>{{$category->title}}</td>
                        <td>{{$category->created_at}}</td>
                        <td>{{$category->updated_at}}</td>
                        <td></td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
        	@include('pagination.large', ['paginator' => $categories])
        </div>
    </div>

  </div>
</div><!-- /.row -->
@endsection
