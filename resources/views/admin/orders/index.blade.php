@extends('admin.dashboard')

@section('content')
<div class='row'>
  <div class="col-md-12">

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Orders List({{$orders->total()}})</h3>
            <div class="box-tools">
                <a href="{{route('admin/orders')}}"><span class="label label-success">All</span></a>
                <a href="{{route('admin/orders/index/paid')}}"><span class="label label-success">Paid</span></a>
                <a href="{{route('admin/orders/index/unpaid')}}"><span class="label label-success">Unpaid</span></a>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover table-striped">
                <tbody>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Order ID</th>
                        <th>User ID</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Updated</th>
                    </tr>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->order_id}}</td>
                        <td>{{$order->user_id}}</td>
                        <td>￥{{ $order->amount }}</td>
                        <td>{{$order->state}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>{{$order->updated_at}}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
        	@include('pagination.large', ['paginator' => $orders])
        </div>
    </div>

  </div>
</div><!-- /.row -->
@endsection
