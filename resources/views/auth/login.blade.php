@extends('layouts.guest')

@section('main-content')
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="my-4">
            <label class="form-label my-label my-4" for="email">
                Email
            </label>
            <input class="rounded-5 ps-4 form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" placeholder="Inserici la mail..." required>
            @error('email')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Password -->
        <div class="my-4">
            <label class="form-label my-4 my-label" for="password">
                Password
            </label>
            <input class="rounded-5 ps-4 form-control @error('password') is-invalid @enderror" type="password" id="password" name="password" placeholder="Inserisci la password..." required>
            @error('password')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="my-4">
            <label for="remember_me">
                <input class="form-check-input" id="remember_me" type="checkbox" name="remember">
                <span class="fw-bold my-blue">Remember me</span>
            </label>
        </div>

        <div class="my-4">
            @if (Route::has('password.request'))
                <a class="my-blue" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
            <button class="ms-5 btn login-btn" type="submit">
                <span>Log in</span> 
            </button>
        </div>
    </form>
@endsection
