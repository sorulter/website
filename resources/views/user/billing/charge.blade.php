@extends('user.dashboard')

@section('content')
<section class="content-header">
<div class="row">
    <div class="col-xs-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Charge <small>Alipay</small></h3>
            </div>
            <!-- /.box-header -->
            @if ($order == null)
            <form class="form-horizontal" method="post" target="_blank">
                {!! csrf_field() !!}

                <div class="box-body">
                    <div class="form-group">
                        <label for="amount" class="col-sm-2 control-label">Amount</label>
                        <div class="col-sm-5">
                            <select name="amount" class="form-control select2" style="width: 100%;">
                                <option value="1" disabled="disabled">¥ 1.00（1Gb 永久流量）</option>
                                <option value="10">¥ 10.00（10GB 永久流量）</option>
                                <option value="20">¥ 20.00（20GB 永久流量）</option>
                                <option value="30">¥ 30.00（20GB/月 自然月包月流量套餐）</option>
                                <option value="50">¥ 50.00（50GB 永久流量）</option>
                                <option value="100">¥ 100.00（100GB 永久流量）</option>
                                <option value="100" selected="selected">¥ 160.00（20GB/月 半年流量套餐）</option>
                                <option value="200">¥ 200.00（200GB 永久流量）</option>
                                <option value="300">¥ 300.00（20GB/月 包年流量套餐）</b></option>
                                <option value="500">¥ 500.00（500GB 永久流量）</option>
                                <option value="1000">¥ 1000.00（1000GB 永久流量）</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <input type="digital" class="form-control" id="amount" name="coupon" placeholder="coupon">
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-danger">Charge</button>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                </div>
                <!-- /.box-footer -->
            </form>
            @endif

            @if ($order != null)
            <div class="box-body">
                <div class="form-group">
                    <h3><i class="icon fa fa-warning"></i> There is an order need to pay!</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Amount</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <body>
                            <tr>
                                <td>{{ $order->order_id }}</td>
                                <td>{{ $order->amount }}</td>
                                <td>{{ $order->created_at }}</td>
                            </tr>
                        </body>
                    </table>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="pull-right"><a class="btn btn-info" href="/user/billing/continue/{{ $order->order_id }}">Continue</a></div>
            </div>
            <!-- /.box-footer -->

            @endif

        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
@stop
