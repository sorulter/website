@extends('user.dashboard')

@section('content')
<div class='row'>
  <div class="col-md-12">
    <div class="col-md-6">

        <div class="box box-info">
        @if ($user->activate == 0)
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('home.activate') }}</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            {!! trans('home.activate_guide',[
                'before' => \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->addDays(2),
                'free_flows' => env('FREE_FLOWS')/MB,
                'activate_send_url' => route('activate/send'),
            ]) !!}
            </div>
        @else
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('home.welcome') }}</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
            {!! trans('home.intro') !!}
            </div>
        @endif
            <!-- /.box-body -->

            <div class="box-footer no-padding" style="display: block;">
            </div>
            <!-- /.footer -->
        </div>

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('home.account_info')}}</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-striped">
                    <tbody>
                        @if ($user->activate == 1)
                            <tr>
                                <td><span><i class="fa fa-btc"></i>&emsp;{{trans('home.forever_flows')}}</span></td>
                                <td><span title="{{$user->flows->forever}} Bytes">{{number_format($user->flows->forever/MB, 2)}} MB</span></td>
                            </tr>
                            <tr>
                                <td><span><i class="fa fa-rmb"></i>&emsp;{{trans('home.combo_flows')}}</span></td>
                                <td><span title="{{$user->flows->combo}} Bytes">{{number_format($user->flows->combo/MB, 2)}} MB</span></td>
                            </tr>
                            <tr>
                                <td><span><i class="fa fa-dollar"></i>&emsp;{{trans('home.extra_flows')}}</span></td>
                                <td><span title="{{$user->flows->extra}} Bytes">{{number_format($user->flows->extra/MB, 2)}} MB</span></td>
                            </tr>
                            <tr>
                                <td><span><i class="fa fa-tachometer"></i>&emsp;{{trans('home.used_flows')}}</span></td>
                                <td><span title="{{$user->flows->used}} Bytes">{{number_format($user->flows->used/MB, 2)}} MB</span></td>
                            </tr>
                            <tr>
                                <td><span><i class="fa fa-sign-in"></i>&emsp;{{trans('home.front_end')}}</span></td>
                                @if ($user->port)
                                <td>{{$user->port->node_name}}</td>
                                @else
                                <td>No server.</td>
                                @endif
                            </tr>
                            <tr>
                                <td><span><i class="fa fa-clock-o"></i>&emsp;{{trans('home.combo_end_date')}}</span></td>
                                <td>@if ($user->flows->combo_end_date > date('Y-m-d H:i:s'))
                                    {{$user->flows->combo_end_date}}
                                @else
                                    <a href="/user/billing/charge" class="label label-warning">{{trans('home.no_combo')}}</a>
                                @endif
                            </tr>
                            <tr>
                                <td><span><i class="fa fa-server"></i>&emsp;{{trans('home.proxy_server')}}</span></td>
                                @if ($user->port)
                                <td>{{$user->port->node_name}}.{{env('NODE_BASE_NAME')}}</td>
                                @else
                                <td>No server.</td>
                                @endif
                            </tr>
                            <tr>
                                <td><span><i class="fa fa-share-alt"></i>&emsp;{{trans('home.proxy_port')}}</span></td>
                                @if ($user->port)
                                <td>{{$user->port->port}}</td>
                                @else
                                <td>No server port.</td>
                                @endif
                            </tr>
                            <tr>
                                <td><span><i class="fa fa-ticket"></i>&emsp;{{trans('home.pac_url')}}</span></td>
                                <td>{{env('PAC_BASE_URL')}}{{ App\id2hash($user->id)}}</td>
                            </tr>
                            @if (Agent::is('iOS') && Agent::is('Safari'))
                                <tr>
                                    <td><span><i class="fa fa-apple"></i>&emsp;iOS 3/4G</span></td>
                                    <td><a href="{{route('user/cellular')}}">Download</a></td>
                                </tr>
                            @endif
                        @elseif ($user->activate == 0)
                            <tr>Please activate.</tr>
                        @endif

                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->

            <div class="box-footer no-padding" style="display: block;">
            </div>
            <!-- /.footer -->
        </div>

    </div>

    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('home.support')}}</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>Twitter</td>
                            <td><a target="_blank" href="http://twitter.com/iProxier">@iPorxier</a></td>
                        </tr>
                        <tr>
                            <td>Telegram</td>
                            <td><a target="_blank" href="{{ env('TELEGRAM') }}">{{ env('TELEGRAM_NAME') }}</a></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><a href="mailto:master@iProxier.com?Subject=Please help me!" target="_blank">Send Mail to get Support.</a></td>
                        </tr>
                        <tr>
                            <td>QQ</td>
                            <td><a target="_blank" href="{{ env('QQ_QUN_URL') }}"><img border="0" src="https://pub.idqqimg.com/wpa/images/group.png" alt="iProxier" title="iProxier"></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->

            <div class="box-footer no-padding" style="display: block;">
            </div>
            <!-- /.footer -->
        </div>

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('home.how_to_configure')}}</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-4 text-center">
                        <a href="{{ route('user/helps', env('CONF_IOS_AID')) }}">
                            <img src="{{ env('CDN_BASE')}}/static/images/icon/ios.png" alt="ios">
                            <span><h4>ios</h4></span>
                        </a>
                    </div>

                    <div class="col-xs-4 text-center">
                        <a href="{{ route('user/helps', env('CONF_ANDROID_AID')) }}">
                            <img src="{{ env('CDN_BASE')}}/static/images/icon/android.png" alt="android">
                            <span><h4>android</h4></span>
                        </a>
                    </div>

                    <div class="col-xs-4 text-center">
                        <a href="{{ route('user/helps', env('CONF_MAC_AID')) }}">
                            <img src="{{ env('CDN_BASE')}}/static/images/icon/mac.png" alt="mac">
                            <span><h4>mac</h4></span>
                        </a>
                    </div>

                    <div class="col-xs-4 text-center">
                        <a href="{{ route('user/helps', env('CONF_WIN_AID')) }}">
                            <img src="{{ env('CDN_BASE')}}/static/images/icon/windows.png" alt="windows">
                            <span><h4>windows</h4></span>
                        </a>
                    </div>

                    <div class="col-xs-4 text-center">
                        <a href="">
                            <img src="{{ env('CDN_BASE')}}/static/images/icon/control.png" alt="control">
                            <span><h4>control</h4></span>
                        </a>
                    </div>

                    <div class="col-xs-4 text-center">
                        <a href="{{ route('user/helps', '') }}">
                            <img src="{{ env('CDN_BASE')}}/static/images/icon/more.png" alt="more">
                            <span><h4>more</h4></span>
                        </a>
                    </div>

                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer no-padding" style="display: block;">
            </div>
            <!-- /.footer -->
        </div>
    </div>

  </div>
</div><!-- /.row -->
@endsection
