@extends('user.dashboard')

@section('content')
<link rel="stylesheet" href="{{env('CDN_BASE')}}/static/css/price.jquery.css">
<link rel="stylesheet" href="{{ asset("/static/plugins/iCheck/square/blue.css") }}">
<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#combo" data-toggle="tab" class="fa-lg">{{trans('mall.combo_flows')}}</a></li>
                <li><a href="#forever" data-toggle="tab" class="fa-lg">{{trans('mall.forever_flows')}}</a></li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="combo">
                <div class="row">
                    <form class="form-group" action="{{ route('user/mall/payment') }}" method="post" target="_blank">
                        {!! csrf_field() !!}
                        <div class="col-xs-12 col-md-8">
                            <div class="box box-solid table-responsive no-padding">
                                <div class="box-header with-border">
                                    <h3 class="box-title">{{trans('mall.products')}}</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <label>{{trans('mall.flows_per_month')}}</label>
                                    <div class="checkbox icheck">
                                        <div class="row">
                                        @foreach ($combos as $combo)
                                            <div class="col-xs-6 col-md-3">
                                                <input type="radio" name="product" data-price="{{$combo->price}}" class="flat-blue" value="{{$combo->id}}"/>
                                                <span style="font-weight: 900;font-size: 1.2em;">{{$combo->name}}</span>
                                            </div>
                                        @endforeach
                                        </div>
                                    </div>

                                    <label>{{trans('mall.duration')}}</label>
                                    <div class="slider-date" id="slider-date-combo">
                                        <input type="hidden" name="index" value="0" />
                                        <!--底层-->
                                        <ul class="slider-bg clearfix" style="width: 612px;">
                                            <li>1</li>
                                            <li>2</li>
                                            <li>3</li>
                                            <li>4</li>
                                            <li>5</li>
                                            <li>6</li>
                                            <li>7</li>
                                            <li>8</li>
                                            <li>9</li>
                                            <li>10</li>
                                            <li>11</li>
                                            <li>1{{trans('mall.years')}}</li>
                                        </ul>

                                        <div class="slider-bar">
                                            <ul class="slider-bg clearfix">
                                                <li>1<span>1{{trans('mall.months')}}</span></li>
                                                <li>2<span>2{{trans('mall.months')}}</span></li>
                                                <li>3<span>3{{trans('mall.months')}}</span></li>
                                                <li>4<span>4{{trans('mall.months')}}</span></li>
                                                <li>5<span>5{{trans('mall.months')}}</span></li>
                                                <li>6<span>6{{trans('mall.months')}}</span></li>
                                                <li>7<span>7{{trans('mall.months')}}</span></li>
                                                <li>8<span>8{{trans('mall.months')}}</span></li>
                                                <li>9<span>9{{trans('mall.months')}}</span></li>
                                                <li>10<span>10{{trans('mall.months')}}</span></li>
                                                <li>11<span>11{{trans('mall.months')}}</span></li>
                                                <li>1{{trans('mall.years')}}<span>1{{trans('mall.years')}}</span></li>
                                            </ul>
                                            <a class="slider-bar-btn"><i></i><i></i></a>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="box box-solid table-responsive no-padding">
                                <div class="box-header with-border">
                                    <h3 class="box-title">{{trans('mall.fees')}}</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-6 col-xs-6">
                                            <small>{{ trans('mall.orig') }}</small>
                                            <h5><i class="fa text-red">￥ <span class="orig">0.00</span></i></h5>
                                        </div>
                                        <div class="col-md-6 col-xs-6">
                                            <small>{{ trans('mall.discount') }}</small>
                                            <h5><i class="fa text-green">￥ <span class="discount">0.00</span></i></h5>
                                        </div>
                                    </div>
                                    <small>{{ trans('mall.subtotal') }}</small>
                                    <h3><i class="fa text-yellow">￥ <span class="subtotal">0.00</span></i></h3>

                                    <div class="checkbox icheck">
                                        <input type="radio" name="payment" class="flat-red" data-rate="0.01" value="alipay" checked />
                                        <span><img style="height: 3em;" src="{{env('CDN_BASE')}}/static/images/alipay.gif"></span>
                                    </div>
                                    <button type="submit" class="btn btn-warning btn-flat col-xs-12">{{trans('mall.pay')}}</button>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <!-- /.tab-pane -->
            	<h1>forever</h1>
            <div class="tab-pane" id="forever">
            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->

    </div>
</div>
@stop

@section('script')
<script src="{{env('CDN_BASE')}}/static/js/price.jquery.js"></script>
<script src="{{env('CDN_BASE')}}/static/plugins/iCheck/icheck.min.js"></script>
<script type="text/javascript">
$(function() {
    function price() {
        unit_price = Number($('input[name=product]:checked').attr('data-price')).toFixed(2);
        fee_rate = Number($('input[name=payment]:checked').attr('data-rate')).toFixed(2);
        index = Number($('input[name=index]').val());
        fee = (index+1)*unit_price*fee_rate;
        orig = (index+1)*unit_price+fee;

        // Calc discount.
        discount = 0;
        if ($('input[name=payment]:checked').val() == 'alipay') {
            discount = discount+fee;
        }

        // subtotal
        subtotal = orig - discount;

        $('#orig').text(orig);
        $('#discount').text(discount.toFixed(2));
        $('#subtotal').text(subtotal.toFixed(2));
    };
    $('input[name=product]')[0].checked = true;
    $('input[name=product]').on("ifChecked", function() {price()});
    price();

    $("#slider-date-combo").sliderDate({
        callback: function(index){
            $('input[name=index]').val(index);
            price();
        }
    });

    $('input[type=radio]').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });
});
</script>
@stop
