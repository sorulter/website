@extends('user.dashboard')

@section('content')
<link rel="stylesheet" href="{{env('CDN_BASE')}}/static/css/price.jquery.css">
<link rel="stylesheet" href="{{ asset("/static/plugins/iCheck/square/blue.css") }}">
<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#combo" data-toggle="tab" class="fa-lg">{{trans('mall.combo_flows')}}</a></li>
                <li><a href="#free" data-toggle="tab" class="fa-lg">{{trans('mall.forever_flows')}}</a></li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="combo">
                <div class="row">
                    <form class="form-group" action="#" method="post">
                        <div class="col-xs-12 col-md-8">
                            <div class="box box-solid table-responsive no-padding">
                                <div class="box-header with-border">
                                    <h3 class="box-title">{{trans('mall.chose')}}</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <label>{{trans('mall.flows_per_month')}}</label>
                                    <div class="checkbox icheck">
                                        <label>
                                        @foreach ($products as $product)
                                            <input type="radio" name="product" data-price="{{$product->price}}" class="flat-blue" />
                                            <span style="font-weight: 900;font-size: 1.2em;">{{$product->name}}</span>
                                        @endforeach
                                        </label>
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
                                            <li>1{{trans('mall.years')}}</li>
                                            <li>2{{trans('mall.years')}}</li>
                                            <li>3{{trans('mall.years')}}</li>
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
                                                <li>1{{trans('mall.years')}}<span>1{{trans('mall.years')}}</span></li>
                                                <li>2{{trans('mall.years')}}<span>2{{trans('mall.years')}}</span></li>
                                                <li>3{{trans('mall.years')}}<span>3{{trans('mall.years')}}</span></li>
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
                                    <h3 class="box-title">{{trans('mall.price')}}</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <span>{{ trans('mall.subtotal') }}</span>
                                    <h3><i class="fa">￥ <span id="subtotal">9.00</span></i></h3>
                                    <div class="checkbox icheck">
                                        <input type="radio" name="payment" class="flat-red" checked />
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
            <div class="tab-pane" id="free">
            	<h1>forever</h1>
            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->

    </div>
</div>
@stop

@section('script')
<script src="{{env('CDN_BASE')}}/static/js/price.jquery.js"></script>
<script src="{{ asset("/static/plugins/iCheck/icheck.min.js") }}"></script>
<script type="text/javascript">
$(function() {
    function price() {
        unit_price = Number($('input[name=product]:checked').attr('data-price'));
        index = Number($('input[name=index]').val());
        subtotal = ((index+1)*unit_price*1.006).toFixed(2);
        console.log(index, unit_price, subtotal);
        $('#subtotal').text(subtotal);
    };
    $('input[name=product]')[0].checked = true;
    $('input[name=product]').on("change", function() {price()});
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
