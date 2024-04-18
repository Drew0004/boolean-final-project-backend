@section('page-title', 'Accedi')
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
        <form method="POST" action="{{ route('login') }}">
            @csrf
    
            <!-- Email Address -->
            <div class="my-4">
                <label class="form-label my-label " for="email">
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
                <label class="form-label  my-label" for="password">
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
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.querySelector('form');
    
            form.addEventListener('submit', function (event) {
                // Prevenie il submit del form
                event.preventDefault();
    
                // Perform validation
                const emailInput = document.getElementById('email');
                const passwordInput = document.getElementById('password');
                let isValid = true;
    
                // Validazione email
                if (!isValidEmail(emailInput.value)) {
                    isValid = false;
                    displayError(emailInput, 'Indirizzo email non valido');
                } else {
                    removeError(emailInput);
                }
    
                // Validazione PSW
                if (passwordInput.value.length < 8) {
                    isValid = false;
                    displayError(passwordInput, 'La password deve contenere almeno 9 caratteri');
                } else {
                    removeError(passwordInput);
                }
    
                // Se è valida -> submitta il form
                if (isValid) {
                    form.submit();
                }
            });
    
            function isValidEmail(email) {
                // Controllo-Validazione della email
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }
    
            function displayError(inputElement, errorMessage) {
                const errorDiv = document.createElement('div');
                errorDiv.className = 'alert alert-danger';
                errorDiv.textContent = errorMessage;
    
                // Remove existing error message if any
                removeError(inputElement);
    
                // Inserisci il nuovo messaggio di errore
                inputElement.parentNode.appendChild(errorDiv);
            }
    
            function removeError(inputElement) {
                const errorDiv = inputElement.parentNode.querySelector('.alert.alert-danger');
                if (errorDiv) {
                    errorDiv.remove();
                }
            }
        });
    </script>  
@endsection
