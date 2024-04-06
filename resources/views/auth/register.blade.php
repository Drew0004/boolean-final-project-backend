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
    <section id="forms">
        <form method="POST" action="{{ route('register') }}">
            @csrf
    
            <!-- Name -->
            <div class="my-4">
                <label class="form-label my-label" for="name">
                    Nome
                </label>
                <input class="rounded-5 ps-4 form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" placeholder="Inserisci il nome..." required maxlength="255">
                @error('name')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
    
            <!-- Email Address -->
            <div class="my-4">
                <label class="form-label my-label" for="email">
                    Email
                </label>
                <input class="rounded-5 ps-4 form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" placeholder="Inserisci la mail..." required maxlength="255">
                @error('email')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
    
            <!-- Password -->
            <div class="my-4">
                <label class="form-label my-label" for="password">
                    Password
                </label>
                <input class="rounded-5 ps-4 form-control @error('password') is-invalid @enderror" type="password" id="password" placeholder="Inserisci la password..." name="password" required>
                @error('password')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
    
            <!-- Confirm Password -->
            <div class="my-4">
                <label class="form-label my-label" for="password_confirmation">
                    Conferma Password
                </label>
                <input class="rounded-5 ps-4 form-control @error('password_confirmation') is-invalid @enderror" type="password" id="password_confirmation" placeholder="Conferma la password..." name="password_confirmation" required>
                @error('password_confirmation')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
    
            <!-- City -->
            <div class="my-4">
                <label class="form-label my-label" for="city">
                    Città
                </label>
                <input class="rounded-5 ps-4 form-control @error('city') is-invalid @enderror" type="text" id="city" name="city" placeholder="Inserisci una città (es.Milano)..." required maxlength="255">
                @error('city')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
    
            <div class="mb-4">
                        
                <div class="form-label my-label">Ruoli</div>
                @foreach ($roles as $role)
                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input role-checkbox @error('roles') is-invalid @enderror"
                            type="checkbox"
                            id="role-{{ $role->id }}"
                            name="roles[]"
                            value="{{ $role->id }}"
                            minlength="1">
                        <label class="form-check-label fw-bold my-blue" for="role-{{ $role->id }}">{{ $role->title }}</label>
                    </div>
                @endforeach
                @error('roles')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
    
            <div class="my-4">
                <a class="text-decoration-none my-blue" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
            
                <button class="ms-5 btn login-btn" type="submit">
                    <span>Registrati</span>
                </button>
                
            </div>
        </form>
    </section>
@endsection
