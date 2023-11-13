<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="/css/app_{{ Cookie::get('theme') ?? 'blue' }}.css" rel="stylesheet" id="theme-stylesheet">
        <title>Meal Planner</title>
    </head>
    <body>
        <div class="container" id="app">
            @if (session('success'))
                <div class="position-relative d-flex justify-content-center">
                    <div class="alert alert-success alert-dismissible shadow position-absolute">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            {{ $slot }}
        </div>
    </body>
    <script type="text/javascript" src="{{ mix('/js/app.js') }}"></script>
    @isset($scripts)
        {{ $scripts }}
    @endisset
</html>
