@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('main-content')
<style>
    #dashboard .hero-section {
        background-image: url('{{ asset("storage/".$user->userDetails->picture) }}');
        min-height: 400px;
        background-size: cover;
        background-position: 0 40%; 
    }
  </style>


<section id="dashboard">
    
    {{-- Sezione Hero Profilo --}}
    @isset($user->userDetails->picture)
    <div class="hero-section d-flex align-items-center bounce-in">
        <div class="container">
            <h1 class="text-white fw-bold mb-0 bounce-in-x">
                Bentornato, <br>
                {{ $user->name }}
            </h1>
        </div>
    </div>
    @else
    <div class="img-not-found d-flex align-items-center bounce-in">
        <div class="container">
            <h1 class="text-white fw-bold mb-0 bounce-in-x">
                Immagine da inserire...
            </h1>
        </div>
    </div>
    @endisset

    {{-- Sezione Dati --}}
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto">
                <h2 class="py-5">
                    I tuoi dati:
                </h2>
            </div>
            @if(!$usersWithoutSponsorship->contains($user) && $sponsoredUser->contains($user))
            <div class="col-auto">
                <h4 class="badge text-bg-success mb-sm-5 mb-md-0  fs-4 bounce-in-y">
                    Attualmente sei sponsorizzato!
                </h4>
            </div>
            @endif
        </div>

    </div>
    
    {{-- Sezione ruoli e bio --}}
    <section class="bio-role-section">
        <div class="container">
            <div class="row justify-content-between py-5">
                <div class="col-8">
                    <h2 class="text-white">
                        Bio
                    </h2>
                    @isset($user->userDetails->bio)
                    <p class="text-white pt-4">{{ $user->userDetails->bio }}</p>
                    @else 
                    <span class="badge text-bg-danger">Bio mancante! Aggiorna le tue informazioni</span>
                    @endisset
                </div>
                <div class="col-auto">
                    <h2 class="text-white">
                        Competenze
                    </h2>
                    @isset($user->roles)
                    <div class="row justify-content-around">
                        @foreach($user->roles as $singleRole)
                            <div class="role-icon pt-4">
                                <img class="w-100 single-icon" src="{{ asset('storage/'.$singleRole->icon) }}" alt="Icona ruolo">
                            </div>
                        @endforeach
                    </div>
                    @else 
                    <span class="badge text-bg-danger">Nessun ruolo assegnato</span>
                    @endisset
                </div>
            </div>
        </div>
    </section>

    <section class="demo-contact-section">
        <div class="container">
            <h2 class="py-5">
                Demo
            </h2>
            @isset($user->userDetails->demo)
                <audio class="w-100" controls>
                    <source src="{{ asset('storage/'.$user->userDetails->demo) }}" type="audio/mpeg">
                </audio>
            @else 
            <span class="badge text-bg-danger">Demo non presente</span>
            @endisset
            <h2 class="py-5">
                Info di contatto
            </h2>
            <div class="fs-5 pb-3">
                <i class="fa-solid fa-envelope me-3 my-blue"></i>
                <span class="fw-bold">Mail: </span><span class="fw-semibold">{{ $user->email }}</span>
            </div>
            @isset($user->userDetails->cellphone)
            <div class="fs-5 pb-5">
                <i class="fa-solid fa-phone me-3"></i>
                <span class="fw-bold">Cell: </span><span class="fw-semibold">{{ $user->userDetails->cellphone }}</span> 
            </div>
            @else
            <span class="badge text-bg-danger">Cellulare mancante! Aggiorna le tue informazioni</span>
            @endisset
            <div class="text-center py-5">
                @if(
                    $user->userDetails->bio == null
                    ||
                    $user->userDetails->picture == null
                    ||
                    $user->userDetails->cellphone == null
                    ||
                    $user->userDetails->demo == null
                    )
                    <button class="btn edit-btn">
                        <a class="text-decoration-none" href="{{ route('admin.edit') }}">Modifica il profilo</a>
                    </button>
                @endif
            </div>
            
        </div>
    </section>

</section>
@endsection

{{-- <h1 class="text-center text-success">
    Bentornato, {{ $user->name }}
</h1>
<h3>I tuoi dati:</h3>
<ul class="list-unstyled">
    <li>Città: {{ $user->city }}</li>
    
    @isset($user->userDetails->bio)
    <li>Bio: {{ $user->userDetails->bio }}</li>
    @else 
    <li class="badge text-bg-danger">Bio mancante! Aggiorna le tue informazioni</li>
    @endisset

    @isset($user->userDetails->cellphone)
    <li>Cellulare: {{ $user->userDetails->cellphone }}</li>
    @else 
    <li class="badge text-bg-danger">Cellulare mancante! Aggiorna le tue informazioni</li>
    @endisset

    @isset($user->userDetails->members)
    <li>Membri: {{ $user->userDetails->members }}</li>
    @endisset

    @isset($user->userDetails->picture)
    <li><img style="width: 100px" src="{{ asset('storage/'.$user->userDetails->picture) }}" alt=""></li>
    @else 
    <li class="badge text-bg-danger">Immagine mancante! Aggiorna le tue informazioni</li>
    @endisset

    @isset($user->userDetails->demo)
    <li>
        Demo:
        <audio controls>
            <source src="{{ asset('storage/'.$user->userDetails->demo) }}" type="audio/mpeg">
        </audio>
    </li>
    @else 
    <li class="badge text-bg-danger">Demo non presente</li>
    @endisset

    @isset($user->roles)
        @foreach($user->roles as $singleRole)
            <li>{{ $singleRole->title }}</li>
        @endforeach
    @else 
        <li class="badge text-bg-danger">Nessun ruolo assegnato</li>
    @endisset

    @isset($user->roles)
        @foreach($user->roles as $singleRole)
        <li><img style="width: 30px" src="{{ asset('storage/'.$singleRole->icon) }}" alt=""></li>
        @endforeach
    @else 
    <li class="badge text-bg-danger">Nessun ruolo assegnato</li>
    @endisset

    
</ul>
    @if(
    $user->userDetails->bio == null
    ||
    $user->userDetails->picture == null
    ||
    $user->userDetails->cellphone == null
    ||
    $user->userDetails->demo == null
    )
        <button class="btn btn-primary">
            <a class="text-decoration-none text-white" href="{{ route('admin.edit') }}">Modifica il profilo</a>
        </button>
    
    @endif --}}