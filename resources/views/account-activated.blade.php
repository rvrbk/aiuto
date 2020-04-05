<!doctype html>
<html>
    <head>
        <title>Cabhair</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf8">
        <link rel="shortcut icon" href="{{ env('APP_URL') }}/favicon.png">
        <link rel="stylesheet" href="{{ env('APP_URL') }}/css/app.css">
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-162617045-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-162617045-1');
        </script>
    </head>
    <body>
        <div class="view center">
        @if($user) 
            Hello {{ $user->name }}, your account has been activated. Click&nbsp;<a href="{{ env('APP_URL') }}">here</a>&nbsp;to return to Cabhair.
        @else
            Hi, your account could not be found. Click&nbsp;<a href="{{ env('APP_URL') }}">here</a>&nbsp;to return to Cabhair.
        @endif
        </div>

        <script src="./js/app.js"></script>
    </body>
</html>