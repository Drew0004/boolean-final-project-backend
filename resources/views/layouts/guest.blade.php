<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/svg+xml" href="/Logo.png" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
         {{-- Font awesome --}}
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <title>@yield('page-title')</title>

        <!-- Scripts -->
        @vite('resources/js/app.js')
    </head>
    <body class="d-flex flex-column min-vh-100">
        <header>
            <nav class="navbar navbar-expand-lg my-blue-bg py-4">
                <div class="container">
                    <div class="logo-container">
                        <a class="header-logo d-inline-block" href="http://localhost:5174/"></a>
                    </div>
                    <div class="collapse navbar-collapse" id="navbarText">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            @auth
                                <li class="nav-item">
                                    <a class="nav-link my-cyan" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                            @else
                                <li class="nav-item my-cyan">
                                    <a class="nav-link my-cyan" href="{{ route('login') }}">Accedi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link my-cyan" href="{{ route('register') }}">Registrati</a>
                                </li>
                            @endauth
                        </ul>

                        @auth
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit" class="btn my-logout-btn">
                                    Log Out
                                </button>
                            </form>
                        @endauth
                    </div>
                </div>
            </nav>
        </header>

        <main class="py-4 flex-grow-1">
            <div class="container">
                @yield('main-content')
            </div>
        </main>
        @php
        $footerLink =[
            'Community'=>[
                'Blog',
                'Community',
                'Ideas',
                
            ],
            'Company'=>[
                'About us',
                'Team',
                'Affiliati',
                'Contatti',
                'Jobs',
            ],
            'Link Utili'=>[
                'Garanzia',
                'Dichiarazione di prodotto',
                'Privacy Policy',
                'Cookie Policy',
                'Impostazione Cookie'
            ],    
        ];
        @endphp
        <footer class="my-blue-bg">
            <div class="container">
                <div class="row pt-3">
                    <div class="col-lg-3 col-md-3 col-sm-12 py-lg-5 py-md-5 py-sm-3 text-center">
                        <div class="logo-container w-auto"> 
                            <a class="footer-logo " href="http://localhost:5174/"></a>
                        </div>
                        <div class="p-sm-1 p-md-3">
                            <p class="my-cyan">
                                Seguici su
                            </p>
                        </div>
                        <ul class="list-unstyled d-flex justify-content-center ">
                            <li class="px-2">
                                <a href="#nogo"><i class="fa-brands fa-facebook-f my-cyan"></i></a>
                            </li>
                            <li class="px-2">
                                <a href="#nogo"><i class="fa-brands fa-instagram my-cyan"></i></a>
                            </li>
                            <li class="px-2">
                                <a href="#nogo"><i class="fa-brands fa-twitter my-cyan"></i></a>
                            </li>
                            <li class="px-2">
                                <a href="#nogo"><i class="fa-brands fa-youtube my-cyan"></i></a>
                            </li>
                        </ul>
                    </div>
                    @foreach($footerLink as $title => $elem)
                        <div class="col-lg-3 col-md-3 col-sm-12 py-lg-5 py-md-5 py-sm-3 text-center text-lg-start">
                            <div class="col-md-12 text-center">
                                <ul class="p-0">
                                    <h4 class="my-cyan">{{$title}}</h4>
                                    @foreach ($elem as $singleElem)
                                        <li class="py-1">
                                            <a class="text-decoration-none my-cyan nav-link" href="#nogo">{{$singleElem}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                    <div>
                        <p class="footer-claim pb-3 mb-0 text-center">
                            BMusic asserts its exclusive rights over all content featured on this website. Unauthorized use, reproduction, distribution, display, or transmission of any content is strictly prohibited without prior authorization from BMusic. All rights reserved.
                        </p>
                    </div>
                </div>
                
            </div>
        </footer>
    </body>
</html>
