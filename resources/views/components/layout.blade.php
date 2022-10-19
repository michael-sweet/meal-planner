<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="/css/app.css" rel="stylesheet">
    </head>
    <body>
        <div class="navbar navbar-expand-lg mb-5">
            <div class="collapse navbar-collapse">
                <ul class="container navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('view_meals') }}">Meals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('view_ingredients') }}">Ingredients</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container">
            {{ $slot }}
        </div>
    </body>
    <script type="text/javascript" src="/js/app.js"></script>
</html>
