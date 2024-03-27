@extends('layouts.guest')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-primary">
                        Benvenuto!
                    </h1>
                    <br>
                    <button class="btn btn-primary">
                        <a class="text-decoration-none text-white" href="{{ route('login') }}">Accedi</a>
                    </button>
                    <button class="btn btn-success">
                        <a class="text-decoration-none text-white" href="{{ route('register') }}">Registrati</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
