<!doctype html>
<html>
    <head>
        <title>Aiuto</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
        <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
        <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
        <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
        <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-clustering.js"></script>
        
        <meta charset="utf8">
        <link rel="stylesheet" href="{{ env('APP_URL') }}/css/app.css">
        <link rel="shortcut icon" href="{{ env('APP_URL') }}/favicon.png">
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
        <section id="vue-app">
            <router-view></router-view>
        </section>

        <script src="./js/app.js"></script>
    </body>
</html>