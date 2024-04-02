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
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <label for="name">
                Nome
            </label>
            <input type="text" id="name" name="name" required maxlength="255">
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <label for="email">
                Email
            </label>
            <input type="email" id="email" name="email" required maxlength="255">
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password">
                Password
            </label>
            <input type="password" id="password" name="password" required>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation">
                Conferma Password
            </label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <!-- City -->
        <div class="mt-4">
            <label for="city">
                Città
            </label>
            <input type="text" id="city" name="city" placeholder="Inserisci una città (es.Milano)..." required maxlength="255">
        </div>

        <div>
            <a href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <button type="submit">
                Registrati
            </button>
        </div>
    </form>
@endsection
