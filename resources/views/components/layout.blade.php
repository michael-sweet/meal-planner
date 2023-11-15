<html>
    <head>
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-Y3Z5NVC2FM"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-Y3Z5NVC2FM');
        </script>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="/css/app_{{ Cookie::get('theme') ?? 'blue' }}.css" rel="stylesheet" id="theme-stylesheet">
        <title>Meal Planner</title>
        <style>
            html::before {
                @isset($bgimg)
                    background-image: url('{{ $bgimg }}');
                @endisset
            }
        </style>
    </head>
    <body>
        <div class="navbar navbar-expand-sm shadow">
            <div class="container">
                <a class="navbar-brand" href="/">
                    {{-- <img src="{{ asset('img/logo.svg') }}" height='30px' /> --}}
                    <x-logo></x-logo>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar_nav" aria-controls="navbar_nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbar_nav">
                    <ul class="container-fluid navbar-nav mb-2 mb-sm-0">
                        <li class="nav-item">
                            <a class="nav-link @if(isset($current_nav) && $current_nav == 'meal_selections')active @endif" href="{{ route('selections.calendar') }}">Calendar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(isset($current_nav) && $current_nav == 'meals')active @endif" href="{{ route('meals') }}">Meals</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(isset($current_nav) && $current_nav == 'ingredients')active @endif" href="{{ route('ingredients') }}">Ingredients</a>
                        </li>
                        <li class="nav-item dropdown ms-0 ms-sm-auto">
                            <a id="navbarDropdownTheme" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa-solid fa-palette color-primary"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownTheme">
                                <h6 class="dropdown-header">Themes:</h6>
                                <div class="dropdown-item">
                                    <button class="btn btn-link" onclick="window.switchTheme('blue')"><i class="fa-solid fa-circle fa-xl theme-blue"></i></button>
                                    <button class="btn btn-link" onclick="window.switchTheme('green')"><i class="fa-solid fa-circle fa-xl theme-green"></i></button>
                                    <button class="btn btn-link" onclick="window.switchTheme('purple')"><i class="fa-solid fa-circle fa-xl theme-purple"></i></button>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown ms-0 ms-sm-3">
                            <a id="navbarDropdownUser" class="nav-link dropdown-toggle icon-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa-solid fa-user"></i>{{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownUser">
                                <a class="dropdown-item icon-link" href="{{ route('users.edit') }}">
                                    <i class="fa-solid fa-pen-to-square"></i>Edit profile
                                </a>
                                <a class="dropdown-item icon-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-right-from-bracket"></i>{{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            @if (session('success'))
                <div class="position-relative d-flex justify-content-center">
                    <div class="alert alert-success alert-dismissible shadow position-absolute mt-3 z-3">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            @if ($errors->any())
            <div class="position-relative d-flex justify-content-center">
                <div class="alert alert-danger alert-dismissible shadow position-absolute mt-3 z-3">
                    @if ($errors->count() > 1)
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @else
                        {{ $errors->first() }}
                    @endif
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
        </div>
        <div class="container my-sm-4">
            <div class="row justify-content-center">
                <div class="col g-0 g-sm-3">
                    <div class="container__main @yield('container_class') p-3 p-sm-4 mb-sm-4 rounded shadow" id="app">
                        @isset($breadcrumbs)
                            <ol class="breadcrumb">
                                @foreach ($breadcrumbs as $crumb)
                                    <li class="breadcrumb-item @if ($loop->last) active @endif text-truncate">
                                        @isset ($crumb['link'])
                                            <a href="{{ $crumb['link'] }}">{{ $crumb['title'] }}</a>
                                        @else
                                            {{ $crumb['title'] }}
                                        @endif
                                    </li>
                                @endforeach
                            </ol>
                        @endisset
                        {{ $slot }}
                    </div>
                </div>
                @hasSection('right_container')
                <div class="col-12 col-lg g-0 g-sm-3">
                    <div class="container__main @yield('container_class') p-3 p-sm-4 mb-sm-4 rounded shadow">
                        @yield('right_container')
                    </div>
                </div>
                @endif
            </div>
        </div>

        @if (App::environment('demo'))
            <x-demo_footer></x-demo_footer>
        @endif

        <x-modals.confirm></x-modals.confirm>
    </body>
    <script type="text/javascript" src="{{ mix('/js/app.js') }}"></script>
    @isset($scripts)
        {{ $scripts }}
    @endisset
</html>
