<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{-- Font awesome --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>@yield('page-title') | {{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite('resources/js/app.js')
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg my-blue-bg py-4">
                <div class="container">
                    <div class="logo-container">
                        <a class="header-logo d-inline-block" href="http://localhost:5174/"></a>
                    </div>
                    <div class="collapse navbar-collapse" id="navbarText">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link my-cyan" href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link my-cyan" href="{{ route('admin.edit') }}">Modifica il profilo</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link my-cyan" href="{{ route('admin.messages.index') }}">I miei messaggi</a>
                                {{-- {{ route('admin.message.index') }} --}}
                            </li>
                            <li class="nav-item">
                                <a class="nav-link my-cyan" href="{{ route('admin.reviews.index') }}">Le mie recensioni</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link my-cyan" href="{{ route('admin.statistics') }}">Le mie statistiche</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link my-cyan" href="#nogo">Sponsorizzazioni</a>
                            </li>
                        </ul>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit" class="btn my-logout-btn">
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </nav>
        </header>

        <main>
            @yield('main-content')
        </main>

        <footer class="my-blue-bg">
            <h2 class="text-white py-5 text-center m-0">Footer</h2>
        </footer>
    </body>
</html>
