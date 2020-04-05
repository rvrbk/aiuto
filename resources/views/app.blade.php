<!doctype html>
<html>
    <head>
        <title>Cabhair</title>
        <!-- Contact me if you're in need of a developer. 0031 650 512 842 or rvrbk.dev@gmail.com  -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @yield('js')
        
        <meta charset="utf8">
        <mata name="description" content="A lot of people are in trouble and need help during this Corona crisis. Easily call out for help and easily find people in need of help using Cabhair.">
        <meta name="keywords" content="corona, covid, covid-19, virus, help, crisis, neighbour, isolation, quarantine, relief">
        <meta name="author" contwnt="Rik Verbeek">
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
        @yield('content')

        <script src="./js/app.js"></script>
    </body>
</html>