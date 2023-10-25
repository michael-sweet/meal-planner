<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="/css/app.css" rel="stylesheet">
        <style>
            html::before {
                background-image: url('{{ $bgimg ?? '' }}');
            }
        </style>
    </head>
    <body>
        <div class="navbar navbar-expand-lg mb-5">
            <div class="collapse navbar-collapse">
                <ul class="container navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('calendar') }}">Calendar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('view_meals') }}">Meals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('view_ingredients') }}">Ingredients</a>
                    </li>
                    <li class="nav-item dropdown ms-auto">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container container__main" id="app">
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
