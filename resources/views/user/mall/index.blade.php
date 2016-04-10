@extends('user.dashboard')

@section('content')
<section class="content-header">
<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="pull-left header"><i class="fa fa-cart-plus"></i> {{trans('mall.choose_goods_type')}}</li>
                <li class="active"><a href="#combo" data-toggle="tab">{{trans('mall.combo_flows')}}</a></li>
                <li><a href="#free" data-toggle="tab">{{trans('mall.forever_flows')}}</a></li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="combo">
            	<h1>combo</h1>
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