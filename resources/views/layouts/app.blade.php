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

        {{-- Braintree --}}
        <script src="https://js.braintreegateway.com/web/dropin/1.42.0/js/dropin.min.js"></script>
        <!-- Scripts -->
        @vite('resources/js/app.js')
    </head>

    <?php
    // Facades
    use Illuminate\Support\Facades\Auth; 
    $user = Auth::user();
    ?>

    <style>
        .img-pic{
            background-image: url('{{ asset("storage/".$user->userDetails->picture) }}');
            width: 60px;
            height: 60px;
            overflow: hidden;
            border-radius: 50%;
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        };
   
    </style>

    <body class="d-flex flex-column min-vh-100">
        <header>
            <nav class="navbar navbar-expand-lg my-blue-bg py-4">
                <div class="container">
                    <div class="logo-container">
                        <a class="header-logo d-inline-block" href="http://localhost:5174/"></a>
                    </div>
                    <button class="navbar-toggler my-hmb-menu" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarText">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link my-cyan mt-sm-3 mt-lg-0 fs-lg-em" href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link my-cyan fs-lg-em" href="{{ route('admin.edit') }}">Modifica il profilo</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link my-cyan fs-lg-em" href="{{ route('admin.messages.index') }}">I miei messaggi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link my-cyan fs-lg-em" href="{{ route('admin.reviews.index') }}">Le mie recensioni</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link my-cyan fs-lg-em" href="{{ route('admin.statistics') }}">Le mie statistiche</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link my-cyan fs-lg-em" href="{{ route('admin.sponsorship') }}">Sponsorizzazioni</a>
                            </li>
                        </ul>
                        @isset($user->userDetails->picture)
                        <div class="dropdown">
                            <div class="dropdown-toggle img-pic" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            </div>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ route('admin.edit') }}">Modifica il profilo</a>
                                </li>
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ route('admin.statistics') }}">Le mie statistiche</a>
                                </li>
                                <li class="dropdown-item">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="btn my-logout-btn-2 dropdown-item">
                                            <span>Log Out</span>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        @else
                        <div class="dropdown">
                            <div class="dropdown-toggle img-pic-not-found" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            </div>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ route('admin.edit') }}">Modifica il profilo</a>
                                </li>
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ route('admin.statistics') }}">Le mie statistiche</a>
                                </li>
                                <li class="dropdown-item">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="btn my-logout-btn-2 dropdown-item">
                                            <span>Log Out</span>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        @endisset
                    </div>
                </div>
            </nav>
        </header>
        

        

        <main class="flex-grow-1">
            @yield('main-content')
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
