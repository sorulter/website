@extends('user.dashboard')

@section('content')
<div class="box">
    <div class="box-header"><h3 class="box-title">{{ trans("billing.Billing History") }}</h3></div><!-- /.box-header -->
    <div class="box-body no-padding table-responsive">
        <table class="table table-striped table-hover">
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
                    <td>￥ {{$order->amount}}.00</td>
                    <td><span class="label @if ($order->state == 'ORDER_CREATED')label-info @elseif (in_array($order->state, ['WAIT_BUYER_PAY','WAIT_SELLER_SEND_GOODS','WAIT_BUYER_CONFIRM_GOODS'])) label-warning @elseif ($order->state == 'TRADE_FINISHED') label-success @endif
                        ">{{ trans("billing.{$order->state}") }}</span></td>
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
