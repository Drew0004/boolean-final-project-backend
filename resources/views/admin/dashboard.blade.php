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
                    <ul>
                        <li>{{ $user->city }}</li>
                        
                        @isset($user->userDetails->bio)
                        <li>{{ $user->userDetails->bio }}</li>
                        @else 
                        <li>-</li>
                        @endisset

                        @isset($user->userDetails->cellphone)
                        <li>{{ $user->userDetails->cellphone }}</li>
                        @else 
                        <li>-</li>
                        @endisset

                        @isset($user->userDetails->members)
                        <li>{{ $user->userDetails->members }}</li>
                        @else 
                        <li>-</li>
                        @endisset

                        @isset($user->userDetails->picture)
                        <li><img src="{{ asset('storage/'.$user->userDetails->picture) }}" alt=""></li>
                        @else 
                        <li>-</li>
                        @endisset

                        @isset($user->userDetails->demo)
                        <li>
                            <audio controls>
                                <source src="{{ asset('storage/'.$user->userDetails->demo) }}" type="audio/mpeg">
                                Il tuo browser non supporta l'elemento audio.
                            </audio>
                        </li>
                        @else 
                        <li>-</li>
                        @endisset

                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
