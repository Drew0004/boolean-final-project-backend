@extends('layouts.app')

@section('page-title', 'Edit project')

@section('main-content')
<section id="edit">
    <div class="container">
        <h2 class="text-center py-5 fw-bold">Modifica il profilo</h2>
            {{-- verifico se ci sono errori --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                {{-- Input del nome utente --}}
                <div class="my-4">
                    <label for="username" class="form-label my-label">Nome*</label>
                    <input value="{{ $user->name }}" type="text" class="rounded-5 ps-4 form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Inserisci il Nome..." maxlength="255" required>
                    @error('username')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
    
                {{-- Input della città --}}
                <div class="my-4">
                    <label for="city" class="form-label my-label">Città*</label>
                    <input value="{{ $user->city }}" type="text" class="rounded-5 ps-4 form-control @error('city') is-invalid @enderror" id="city" name="city" placeholder="Inserisci la città..." maxlength="255" required>
                    @error('city')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
    
                {{-- Input della demo --}}
                <div class="my-4">
    
                    @if ($user->userDetails->demo != null)
                    <div>
                        <h4 class="my-label">
                            Demo Attuale:
                        </h4>
                        <div>
                            <audio controls class="w-100 my-4">
                                <source src="{{ asset('storage/'.$user->userDetails->demo) }}" type="audio/mpeg">
                                    {{-- <source src="{{ asset('storage/'.$user->userDetails->demo) }}" type="audio/mpeg"> --}}
                            </audio>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="delete_demo" name="delete_demo">
                            <label class="form-check-label fw-bold my-blue" for="delete_demo">
                                Rimuovi demo
                            </label>
                        </div>
                    </div>
                    @else
                    <label for="demo" class="form-label my-label">Carica una demo!</label>
                    <input class="rounded-5 form-control @error('demo') is-invalid @enderror" type="file" id="demo" name="demo">
                    @error('demo')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    @endif
                </div>
                @error('demo')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
                
                {{-- Input dell'immagine profilo --}}
                <div class="my-4">
                    <label for="picture" class="form-label my-label">Inserisci un'immagine</label>
                    <input class="rounded-5 my-4 form-control @error('picture') is-invalid @enderror" type="file" id="picture" name="picture">
    
                    @if ($user->userDetails->picture != null)
                    <div class="mt-2">
                        <h4 class="">
                            Immagine attuale:
                        </h4>
                        <div class="form-img-round my-4">
                            <img class="w-100 object-fit-cover profile-pic" src="/storage/{{ $user->userDetails->picture }}">
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="delete_picture" name="delete_picture">
                            <label class="form-check-label fw-bold my-blue" for="delete_picture">
                                Rimuovi immagine
                            </label>
                        </div>
                    </div>
                @endif
                </div>
                @error('picture')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
                
                {{-- Input della bio --}}
                <div class="my-4">
                    <label for="bio" class="form-label my-label">Bio</label>
                    <textarea  class="rounded-5 my-4 ps-4 form-control @error('bio') is-invalid @enderror" id="bio" name="bio" rows="3" placeholder="Aggiungi una bio" maxlength="1024">
                    {{ $user->userDetails->bio }}
                    </textarea>
                </div>
                
                {{-- Input del cellulare --}}
                <div class="my-4">
                    <label for="cellphone" class="form-label my-label ">Cellulare</label>
                    <input value="{{ $user->userDetails->cellphone }}" type="text" class="rounded-5 my-4 ps-4 form-control @error('cellphone') is-invalid @enderror" id="cellphone" name="cellphone" placeholder="Inserisci il numero di cellulare..." maxlength="24">
                </div>
                
                {{-- Input dei membri --}}
                @if($user->roles->contains('id', 10))
                <div class="my-3">
                    <label for="members" class="form-label my-label ">Inserisci i membri della tua band</label>
                    <input value="{{ $user->userDetails->members }}" type="text" class="rounded-5 my-4 ps-4 form-control @error('members') is-invalid @enderror" id="members" name="members" placeholder="Inserisci i membri..." maxlength="1024">
                </div>
                @endif
    
                {{-- Input dei ruoli --}}
                <div class="mb-4">
                    <label class="form-label my-label">Ruoli</label>
    
                    <div class="my-4">
                        
                        @foreach ($roles as $role)
                            <div class="form-check form-check-inline">
                                <input
                                    {{-- Se c'è l'old, vuol dire che c'è stato un errore --}}
                                    @if ($errors->any())
                                        {{-- Faccio le verifiche sull'old --}}
                                        {{ in_array($role->id, old('role', [])) ? 'checked' : '' }}
                                    @else
                                        {{-- Faccio le verifiche sulla collezione --}}
                                        {{-- {{ $user->role ? ($user->roles->contains($role->id) ? 'checked' : '') : '' }} --}}
                                        {{ $user->roles->contains($role->id) ? 'checked' : '' }}
                                    @endif
                                    class="form-check-input role-checkbox"
                                    type="checkbox"
                                    id="role-{{ $role->id }}"
                                    name="roles[]"
                                    value="{{ $role->id }}"
                                    minlength="1">
                                <label class="form-check-label fw-bold my-blue" for="role-{{ $role->id }}">{{ $role->title }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                @error('roles')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
                <div class="row justify-content-between py-5">
                    <div class="col-auto">
                        <button class="btn undo-button" type="button">
                            <a class="text-decoration-none" href="{{ route('admin.dashboard') }}">Annulla</a>
                        </button>
                    </div>
                    <div class="col-auto">
                        <button class="btn edit-btn" type="submit">
                            <span>Modifica +</span>
                        </button>
                    </div>
                </div>
            </form>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.querySelector('form');

        form.addEventListener('submit', function (event) {
            // Prevenire il comportamento predefinito di inviare il modulo
            event.preventDefault();

            // Perform validation
            const usernameInput = document.getElementById('username');
            const cityInput = document.getElementById('city');
            const demoInput = document.getElementById('demo');
            const pictureInput = document.getElementById('picture');
            const bioInput = document.getElementById('bio');
            const cellphoneInput = document.getElementById('cellphone');
            const membersInput = document.getElementById('members');
            const roleCheckboxes = document.querySelectorAll('.role-checkbox');
            let isValid = true;

            // Validazione del name
            if (usernameInput.value.trim() === '') {
                isValid = false;
                displayError(usernameInput, 'Inserisci il tuo nome o il nome della tua band');
            } else {
                removeError(usernameInput);
            }

            // Validazione city
            if (cityInput.value.trim() === '') {
                isValid = false;
                displayError(cityInput, 'Inserisci la tua città');
            } else {
                removeError(cityInput);
            }

            // Validazione demo file se fornito
            if (demoInput.value && !isValidDemoFile(demoInput)) {
                isValid = false;
                displayError(demoInput, 'Carica un file Mp3');
            } else {
                removeError(demoInput);
            }

            // Validazione immagine profilo se fornita
            if (pictureInput.value && !isValidPictureFile(pictureInput)) {
                isValid = false;
                displayError(pictureInput, 'Carica un file immagine valido');
            } else {
                removeError(pictureInput);
            }

            // Validazione lunghezza bio
            if (bioInput.value.length > 1024) {
                isValid = false;
                displayError(bioInput, 'La biografia deve contenere meno di 1024 caratteri');
            } else {
                removeError(bioInput);
            }

            // Validazione telefono
            if (cellphoneInput.value.trim() !== '' && !isValidCellphone(cellphoneInput.value)) {
                isValid = false;
                displayError(cellphoneInput, 'Inserisci un numero di cellulare valido');
            } else {
                removeError(cellphoneInput);
            }

            // Validazione membri se forniti
            if (membersInput.value.trim() !== '' && membersInput.value.length > 1024) {
                isValid = false;
                displayError(membersInput, 'La sezione deve contenere meno di 1024 caratteri');
            } else {
                removeError(membersInput);
            }

            // Validazione ruoli inseriti (almeno uno inserito)
            let rolesChecked = false;
            roleCheckboxes.forEach(function (checkbox) {
                if (checkbox.checked) {
                    rolesChecked = true;
                }
            });
            if (!rolesChecked) {
                isValid = false;
                displayError(roleCheckboxes[0], 'Seleziona almeno un ruolo');
            }

            // Se è valida -> submitta il form
            if (isValid === true) {
                form.submit();
            }
        });
    });

    function isValidDemoFile(demoInput) {
        // Validazione formato demo
        const acceptedExtensions = ['mp3'];
        const fileExtension = demoInput.value.split('.').pop().toLowerCase();
        return acceptedExtensions.includes(fileExtension);
    }

    function isValidPictureFile(pictureInput) {
        // Validazione formato immagine
        const acceptedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        const fileExtension = pictureInput.value.split('.').pop().toLowerCase();
        return acceptedExtensions.includes(fileExtension);
    }

    function isValidCellphone(cellphone) {
        // Validazione numero di telefono
        const cellphoneRegex = /^[0-9]{10}$/;
        return cellphoneRegex.test(cellphone);
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
</script>

@endsection