<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="/css/app.css" rel="stylesheet">
    </head>
    <body>
        <div class="container" id="app">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            {{ $slot }}
        </div>
    </body>
    @isset($scripts_before)
        {{ $scripts_before }}
    @endisset
    <script type="text/javascript" src="{{ mix('/js/app.js') }}"></script>
</html>
