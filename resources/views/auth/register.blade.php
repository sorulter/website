@extends('front')

@section('title')
iProxier › {{trans('base.register')}}
@stop

@section('body-class') hold-transition login-page @stop

@section('content')

    <div class="login-box">
    @if ( !empty(Session::get('invitation_msg')) )
    <div class="alert alert-warning alert-dismissible">
        <span class="center">{{Session::get('invitation_msg')}}</span>
    </div>
    @endif

    <div class="login-box-body">
      <p class="login-box-msg"><b>{{trans('base.register_tips')}}</b></p>

      <form method="post" action="/register">
        {!! csrf_field() !!}

        <label class="control-label text-red" for="email" style="display: @if ($errors->default->has('email'))block @else none @endif;">
          <i class="fa fa-times-circle-o"></i>
          <span>{{ $errors->default->first('email') }}</span>
        </label>
        <div class="input-group @if ($errors->default->has('email')) has-error @endif">
          <input type="email" class="form-control" placeholder="{{trans('base.email')}}" name="email" id="email" value="{{ old('email') }}">
          <span class="input-group-addon">
            <i class="glyphicon glyphicon-envelope"></i>
          </span>
        </div>
        <br>

        <label class="control-label text-red" for="password" style="display: @if ($errors->default->has('password'))block @else none @endif;">
          <i class="fa fa-times-circle-o"></i>
          <span>{{ $errors->default->first('password') }}</span>
        </label>
        <div class="input-group">
          <input type="password" class="form-control" placeholder="{{trans('base.password')}}" name="password" id="password">
          <span class="input-group-addon">
            <i class="glyphicon glyphicon-lock"></i>
          </span>
        </div>
        <br>

        <button type="submit" class="btn btn-primary btn-block btn-flat">{{trans('base.register')}}</button>
      </form>
    </div>

    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->
@stop

@section('js')
<style>
.sugg {
  z-index: 9999;
  color: #ccc;
}
</style>
<script src="{{ env('CDN_BASE') }}/static/js/jquery.email-autocomplete.js"></script>
<script type="text/javascript">
$("#email").emailautocomplete();
</script>
@stop
