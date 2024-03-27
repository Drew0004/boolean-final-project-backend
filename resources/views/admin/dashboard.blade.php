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
                        @dd($user->user_details)
                        @isset($user->user_details)
                        <li>{{ $user->user_details->bio }}</li>
                        @else 
                        <li>-</li>
                        @endisset
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
