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
        <div class="navbar navbar-expand-lg">
            <div class="collapse navbar-collapse">
                <ul class="container navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('selections.calendar') }}">Calendar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('meals') }}">Meals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ingredients') }}">Ingredients</a>
                    </li>
                    <li class="nav-item dropdown ms-auto">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
        <div class="container">
            @if (session('success'))
                <div class="position-relative d-flex justify-content-center">
                    <div class="alert alert-success alert-dismissible shadow position-absolute mt-3">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
        </div>
        <div class="container container__main" id="app">
            {{ $slot }}
        </div>
        <x-modals.confirm></x-modals.confirm>
    </body>
    <script type="text/javascript" src="{{ mix('/js/app.js') }}"></script>
    @isset($scripts)
        {{ $scripts }}
    @endisset
</html>
