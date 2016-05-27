@extends('user.dashboard')

@section('content')
<div class="box">
    <div class="box-header"><h3 class="box-title">{{ trans("mall.history_order") }}</h3></div><!-- /.box-header -->
    <div class="box-body no-padding table-responsive">
        <table class="table table-striped table-hover">
            <tbody>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>{{ trans('mall.order_id') }}</th>
                    <th>{{ trans('mall.amount') }}</th>
                    <th>{{ trans('mall.discount') }}</th>
                    <th>{{ trans('mall.quantity') }}</th>
                    <th>{{ trans('mall.created_at') }}</th>
                    <th>{{ trans('mall.operation') }}</th>
                </tr>
                @foreach ($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->order_id}}</td>
                    <td>￥ {{$order->amount}}</td>
                    <td>￥ {{$order->discount}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>{{$order->created_at}}</td>
                    <td>@if ($order->state == 'ORDER_CREATED' || $order->state == 'WAIT_BUYER_PAY')
                        @if ($order->trade_no == "")
                            <a href="{{ route('user/mall/waitpay', $order->id) }}" class="label label-warning" target="_blank">{{ trans('mall.continue_pay') }}</a>
                        @else
                            <a href="https://lab.alipay.com/consume/record/buyerConfirmTrade.htm?tradeNo={{ $order->trade_no }}" class="label label-danger" target="_blank">{{ trans('mall.confirm_pay') }}</a>
                        @endif
                    @elseif($order->state == 'WAIT_SELLER_SEND_GOODS')
                        <span class="label label-info">{{ trans('mall.wait_seller_send_goods') }}</span>
                    @elseif($order->state == 'WAIT_BUYER_CONFIRM_GOODS')
                        <a href="https://lab.alipay.com/consume/queryTradeDetail.htm?actionName=CONFIRM_GOODS&tradeNo={{ $order->trade_no }}" class="label label-danger" target="_blank">{{ trans('mall.confirm_goods') }}</a>
                    @elseif($order->state == 'TRADE_FINISHED')
                        <span class="label label-default">{{ trans('mall.trade_finished') }}</span>
                    @else
                        <span class="label label-danger">{{ trans('mall.error_trade') }}</span>
                    @endif</td>
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
