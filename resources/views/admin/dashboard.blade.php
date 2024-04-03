@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Bentornanto, {{ $user->name }}
                    </h1>
                    <h3>I tuoi dati:</h3>
                    <ul class="list-unstyled">
                        <li>Città: {{ $user->city }}</li>
                        
                        @isset($user->userDetails->bio)
                        <li>Bio: {{ $user->userDetails->bio }}</li>
                        @else 
                        <li>-</li>
                        @endisset

                        @isset($user->userDetails->cellphone)
                        <li>Cellulare: {{ $user->userDetails->cellphone }}</li>
                        @else 
                        <li>-</li>
                        @endisset

                        @isset($user->userDetails->members)
                        <li>Membri: {{ $user->userDetails->members }}</li>
                        @endisset

                        @isset($user->userDetails->picture)
                        <li><img style="width: 100px" src="{{ asset('storage/'.$user->userDetails->picture) }}" alt=""></li>
                        @else 
                        <li>-</li>
                        @endisset

                        @isset($user->userDetails->demo)
                        <li>
                            Demo:
                            <audio controls>
                                <source src="{{ asset('storage/'.$user->userDetails->demo) }}" type="audio/mpeg">
                            </audio>
                        </li>
                        @else 
                        <li>Demo non presente</li>
                        @endisset

                        @isset($user->roles)
                            @foreach($user->roles as $singleRole)
                                <li>{{ $singleRole->title }}</li>
                            @endforeach
                        @else 
                            <li>Nessun ruolo assegnato</li>
                        @endisset

                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
