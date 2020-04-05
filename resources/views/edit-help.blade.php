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
        @if($help) 
            <form method="post">
                @csrf

                <p><label><div>Your name</div><input type="text" required name="name" value="{{ $help->name }}" placeholder="Your name..."></label></p>
                <p><label><div>Summarize your call...</div><input type="text" required name="title" value="{{ $help->title }}" placeholder="Summarize your call..."></label></p>
                <p><label><div>I need help doing...</div><textarea required name="help" placeholder="I need help doing...">{{ $help->help }}</textarea></label></p>
                <p><input type="submit" value="save"></p>
            </form>
        @endif
        </div>

        <script src="./js/app.js"></script>
    </body>
</html>