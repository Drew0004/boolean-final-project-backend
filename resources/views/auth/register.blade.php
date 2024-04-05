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
            <label class="form-label" for="name">
                Nome*
            </label>
            <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" required maxlength="255">
            @error('name')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <label class="form-label" for="email">
                Email*
            </label>
            <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" required maxlength="255">
            @error('email')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label class="form-label" for="password">
                Password*
            </label>
            <input class="form-control @error('password') is-invalid @enderror" type="password" id="password" name="password" required>
            @error('password')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label class="form-label" for="password_confirmation">
                Conferma Password*
            </label>
            <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" id="password_confirmation" name="password_confirmation" required>
            @error('password_confirmation')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- City -->
        <div class="mt-4">
            <label class="form-label" for="city">
                Città*
            </label>
            <input class="form-control @error('city') is-invalid @enderror" type="text" id="city" name="city" placeholder="Inserisci una città (es.Milano)..." required maxlength="255">
            @error('city')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div>
                    
            <div class="form-label">Ruoli*</div>
            @foreach ($roles as $role)
                <div class="form-check form-check-inline">
                    <input
                        class="form-check-input @error('roles') is-invalid @enderror"
                        type="checkbox"
                        id="role-{{ $role->id }}"
                        name="roles[]"
                        value="{{ $role->id }}"
                        minlength="1">
                    <label class="form-check-label" for="role-{{ $role->id }}">{{ $role->title }}</label>
                </div>
            @endforeach
            @error('roles')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div>
            <a class="text-decoration-none" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        
            <button class="ms-2 btn btn-primary" type="submit">
                Registrati
            </button>
            
        </div>
    </form>
@endsection
