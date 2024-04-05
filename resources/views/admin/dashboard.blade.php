@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
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
                        
                        @endif
                </div>
            </div>
        </div>
    </div>
@endsection
