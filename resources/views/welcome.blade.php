@section('page-title', 'Benvenuto')
@extends('layouts.guest')

@section('main-content')
    <div class="row">
        <div class="col">

        <h1 class="text-center my-blue py-3">
            Benvenuto!
        </h1>
        <div class="text-center py-3">
            <button class="btn login-btn fw-semibold me-5">
                <a class="text-decoration-none" href="{{ route('login') }}">Accedi</a>
            </button>
            <button class="btn register-btn">
                <a class="text-decoration-none" href="{{ route('register') }}">Registrati</a>
            </button>
        </div>

        </div>
    </div>
@endsection
