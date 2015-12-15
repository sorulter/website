@extends('front')

@section('content')
    <div class="callout callout-{{ $type }}">
      <h4>{!! $title !!}</h4>
      <p>{!! $content !!}</p>
      <p>Redirect to <a href="{{ $to }}">{{ $to }}</a> after <span id="timer">{{ $time }}</span> second(s).</p>
    </div>
  </section>
@stop

@section('js')
  <script type="text/javascript">
  $(document).ready(function() {
      var timer = $('#timer').text();
      function go() {
          console.log("go");
          window.setTimeout(function() {
              timer--;
              if(timer > 0) {
                  $('#timer').text(timer);
                  go();
              } else {
                  location.href='{{ $to }}';
              }
          }, 1000);
      }

      go();
  });
  </script>
@stop
