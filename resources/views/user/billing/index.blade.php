@extends('user.dashboard')

@section('content')
<div class="box">
    <div class="box-header"><h3 class="box-title">{{ trans("billing.Billing History") }}</h3></div><!-- /.box-header -->
    <div class="box-body no-padding">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>{{ trans('billing.Order ID') }}</th>
                    <th>{{ trans('billing.Amount') }}</th>
                    <th>{{ trans("billing.State") }}</th>
                    <th>{{ trans('billing.Created At') }}</th>
                    <th>{{ trans('billing.Details') }}</th>
                </tr>
                @foreach ($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->order_id}}</td>
                    <td>{{$order->amount}}</td>
                    <td>￥ {{$order->state}}.00</td>
                    <td>{{$order->created_at}}</td>
                    <td>@if ($order->state == $order->OBLIGATION) Continue @else View @endif</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="box-footer clearfix">
        @include('pagination.large', ['paginator' => $orders])
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->

@stop
