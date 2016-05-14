<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="#0183D1">
<link rel="apple-touch-startup-image" href="{{ env('CDN_BASE') }}/static/images/apple/startup.png">

<link rel="apple-touch-icon" href="{{ env('CDN_BASE') }}/static/images/apple/touch-icon-iphone.png">
<link rel="apple-touch-icon" sizes="76x76" href="{{ env('CDN_BASE') }}/static/images/apple/touch-icon-ipad.png">
<link rel="apple-touch-icon" sizes="120x120" href="{{ env('CDN_BASE') }}/static/images/apple/touch-icon-iphone-retina.png">
<link rel="apple-touch-icon" sizes="152x152" href="{{ env('CDN_BASE') }}/static/images/apple/touch-icon-ipad-retina.png">

<script type="text/javascript" charset="utf-8">
// Mobile Safari in standalone mode
if (("standalone" in window.navigator) && window.navigator.standalone) {

    // If you want to prevent remote links in standalone web apps opening Mobile Safari, change 'remotes' to true
    var noddy, remotes = true;

    document.addEventListener('click', function(event) {

        noddy = event.target;

        // Bubble up until we hit link or top HTML element. Warning: BODY element is not compulsory so better to stop on HTML
        while (noddy.nodeName !== "A" && noddy.nodeName !== "HTML") {
            noddy = noddy.parentNode;
        }

        if ('href' in noddy && noddy.href.indexOf('http') !== -1 && (noddy.href.indexOf(document.location.host) !== -1 || remotes)) {
            event.preventDefault();
            document.location.href = noddy.href;
        }

    }, false);
}
</script>
