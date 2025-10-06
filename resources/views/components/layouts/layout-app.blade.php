<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link
            rel="icon"
            href="{{ asset("images/app_icon.png") }}"
            type="image/png"
        />
        <title>@yield("title", "KKU VOLENTEER")</title>
        @vite("resources/css/app.css")
        @vite("resources/js/app.js")
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script
            src="https://kit.fontawesome.com/c813362ef5.js"
            crossorigin="anonymous"
        ></script>
    </head>
    <body>
        <div class="h-screen">
            @include("components.alert")

            @yield("content")
        </div>

        @yield("scripts")
    </body>
</html>
