@extends('user.dashboard')

@section('content')
<div class='row'>
  <div class="col-md-12">
    <div class="col-md-6">

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Free to Try</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <p> &emsp;&emsp;Welcome to use IPX(iPorxier).There is the guide for you.</p>
                @if (!$user->activate)
                    <p>&emsp;&emsp;Click follow button,we will send a activate mail to you.Open your mailbox, click the link in your activate mail,activate before <span class="label label-info">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->addDays(2) }}</span> you can get <span class="label label-info">{{env('FREE_FLOWS')/MB}} MBytes</span> flows to try.</p>
                        <a href="{{ route('activate/send') }}" class="btn btn-success col-xs-12"><b>Send activate mail</b></a>

                @else
                    {{-- false expr --}}
                @endif
            </div>
            <!-- /.box-body -->

            <div class="box-footer no-padding" style="display: block;">
            </div>
            <!-- /.footer -->
        </div>

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Account Info</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-striped">
                    <tbody>
                        @if ($user->activate)
                            <tr>
                                <td><span><i class="fa fa-btc"></i>&emsp;Free Flows</span></td>
                                <td><span title="{{$user->flows->Free}} Bytes">{{$user->flows->free/MB}} MB</span></td>
                            </tr>
                            <tr>
                                <td><span><i class="fa fa-rmb"></i>&emsp;Combo Flows</span></td>
                                <td><span title="{{$user->flows->combo_flows}} Bytes">{{$user->flows->combo_flows/MB}} MB</span></td>
                            </tr>
                            <tr>
                                <td><span><i class="fa fa-tachometer"></i>&emsp;Used Flows</span></td>
                                <td><span title="{{$user->flows->used}} Bytes">{{$user->flows->used/MB}} MB</span></td>
                            </tr>
                            <tr>
                                <td><span><i class="fa fa-sign-in"></i>&emsp;Front End</span></td>
                                @if ($user->port)
                                <td>{{$user->port->node_name}}</td>
                                @else
                                <td>No server.</td>
                                @endif
                            </tr>
                            <tr>
                                <td><span><i class="fa fa-clock-o"></i>&emsp;Combo EndDate</span></td>
                                <td>@if ($user->flows->combo_end_date > date('Y-m-d H:i:s'))
                                    {{$user->flows->combo_end_date}}
                                @else
                                    <a href="/user/billing/charge" class="label label-warning">No combo flows.Order now!</a>
                                @endif
                            </tr>
                            <tr>
                                <td><span><i class="fa fa-server"></i>&emsp;Proxy Server</span></td>
                                @if ($user->port)
                                <td>{{$user->port->node_name}}.{{env('NODE_BASE_NAME')}}</td>
                                @else
                                <td>No server.</td>
                                @endif
                            </tr>
                            <tr>
                                <td><span><i class="fa fa-share-alt"></i>&emsp;Proxy Port</span></td>
                                @if ($user->port)
                                <td>{{$user->port->port}}</td>
                                @else
                                <td>No server port.</td>
                                @endif
                            </tr>
                            <tr>
                                <td><span><i class="fa fa-ticket"></i>&emsp;Pac URL</span></td>
                                <td>{{env('PAC_BASE_URL')}}{{ App\id2hash($user->id)}}</td>
                            </tr>
                            @if (Agent::is('iPhone') && Agent::is('Safari'))
                                <tr>
                                    <td><span><i class="fa fa-apple"></i>&emsp;iOS 3/4G</span></td>
                                    <td><a href="{{route('user/cellular')}}">Download</a></td>
                                </tr>
                            @endif
                        @else
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
                <h3 class="box-title">Support</h3>
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
                            <td><a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=c46a231370e89b87bcc9e1355d6852c355ba9866b012a78c94eca520cc207486"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png" alt="iProxier" title="iProxier"></a></td>
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
                <h3 class="box-title">How to Configure</h3>
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
                            <img src="/static/images/icon/ios.png" alt="ios">
                            <span><h4>ios</h4></span>
                        </a>
                    </div>

                    <div class="col-xs-4 text-center">
                        <a href="{{ route('user/helps', env('CONF_ANDROID_AID')) }}">
                            <img src="/static/images/icon/android.png" alt="android">
                            <span><h4>android</h4></span>
                        </a>
                    </div>

                    <div class="col-xs-4 text-center">
                        <a href="{{ route('user/helps', env('CONF_MAC_AID')) }}">
                            <img src="/static/images/icon/mac.png" alt="mac">
                            <span><h4>mac</h4></span>
                        </a>
                    </div>

                    <div class="col-xs-4 text-center">
                        <a href="{{ route('user/helps', env('CONF_WIN_AID')) }}">
                            <img src="/static/images/icon/windows.png" alt="windows">
                            <span><h4>windows</h4></span>
                        </a>
                    </div>

                    <div class="col-xs-4 text-center">
                        <a href="">
                            <img src="/static/images/icon/control.png" alt="control">
                            <span><h4>control</h4></span>
                        </a>
                    </div>

                    <div class="col-xs-4 text-center">
                        <a href="{{ route('user/helps', '') }}">
                            <img src="/static/images/icon/more.png" alt="more">
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
