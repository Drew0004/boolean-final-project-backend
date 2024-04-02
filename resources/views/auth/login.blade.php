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
        <div>
            <label class="form-label" for="email">
                Email
            </label>
            <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email">
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label class="form-label" for="password">
                Password
            </label>
            <input class="form-control @error('password') is-invalid @enderror" type="password" id="password" name="password">
        </div>

        <!-- Remember Me -->
        <div class="mt-4">
            <label for="remember_me">
                <input class="form-check-input" id="remember_me" type="checkbox" name="remember">
                <span>Remember me</span>
            </label>
        </div>

        <div class="mt-4">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <button class="btn btn-primary" type="submit">
                Log in
            </button>
        </div>
    </form>
@endsection
