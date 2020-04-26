<!doctype html>
<html>
    <head>
        <title>Cabhair</title>
        <!-- Contact me if you're in need of a developer. 0031 650 512 842 or rvrbk.dev@gmail.com  -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @yield('js')
        
        <meta charset="utf8">
        <mata name="description" content="A lot of people are in trouble and need help during this Corona crisis. Easily call out for help and easily find people in need of help using Cabhair.">
        <meta name="keywords" content="corona, covid, covid-19, virus, help, crisis, neighbour, isolation, quarantine, relief, community, social, cabhair, help">
        <meta name="author" contwnt="Rik Verbeek">
        <meta property="og:title" content="Cabhair | {{ __('app.keyphrase') }}" />
        <meta property="og:description" content="{{ __('app.og-description') }}" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="https://cabhair.com/" />
        <meta property="og:image" content="{{ env('APP_URL') }}/art/banner.jpg" />
        <link rel="shortcut icon" href="{{ env('APP_URL') }}/favicon.png">
        <link rel="stylesheet" href="{{ env('APP_URL') }}/css/app.css">
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v6.0&appId=408701179636660&autoLogAppEvents=1"></script>
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
        @yield('content')

        <script src="./js/app.js"></script>
    </body>
</html>