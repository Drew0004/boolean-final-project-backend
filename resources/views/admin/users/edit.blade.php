@extends('layouts.app')

@section('page-title', 'Edit project')

@section('main-content')
  <div>
    <h2 class="text-center py-3 fw-bold">Modifica il profilo</h2>
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
            <div class="my-3">
                <label for="username" class="form-label text-white">Nome*</label>
                <input value="{{ $user->name }}" type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Inserisci il Nome..." maxlength="255" required>
                @error('username')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Input della città --}}
            <div class="my-3">
                <label for="city" class="form-label text-white">Città*</label>
                <input value="{{ $user->city }}" type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" placeholder="Inserisci la città..." maxlength="255" required>
                @error('city')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Input della demo --}}
            <div class="my-3">

                @if ($user->userDetails->demo != null)
                <div class="mt-2">
                    <h4 class="text-white">
                        Demo Attuale:
                    </h4>
                    <div>
                        <audio controls>
                            <source src="{{ asset('storage/'.$user->userDetails->demo) }}" type="audio/mpeg">
                                <source src="{{ asset('storage/'.$user->userDetails->demo) }}" type="audio/mpeg">
                        </audio>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="delete_demo" name="delete_demo">
                        <label class="form-check-label" for="delete_demo">
                            Rimuovi demo
                        </label>
                    </div>
                </div>
                @else
                <label for="demo" class="form-label text-white">Carica una demo!</label>
                <input class="form-control @error('demo') is-invalid @enderror" type="file" id="demo" name="demo">
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
            <div class="mb-3">
                <label for="picture" class="form-label text-white">Inserisci un'immagine</label>
                <input class="form-control @error('picture') is-invalid @enderror" type="file" id="picture" name="picture">

                @if ($user->userDetails->picture != null)
                <div class="mt-2">
                    <h4 class="text-white">
                        Immagine attuale:
                    </h4>
                    <img src="/storage/{{ $user->userDetails->picture }}" style="max-width: 200px;">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="delete_picture" name="delete_picture">
                        <label class="form-check-label" for="delete_picture">
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
            <div class="my-3">
                <label for="bio" class="form-label text-white">Bio</label>
                <textarea  class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio" rows="3" placeholder="Aggiungi una bio" maxlength="1024">
                {{ $user->userDetails->bio }}
                </textarea>
            </div>
            
            {{-- Input del cellulare --}}
            <div class="my-3">
                <label for="cellphone" class="form-label text-white">Cellulare</label>
                <input value="{{ $user->userDetails->cellphone }}" type="text" class="form-control @error('cellphone') is-invalid @enderror" id="cellphone" name="cellphone" placeholder="Inserisci il numero di cellulare..." maxlength="24">
            </div>
            
            {{-- Input dei membri --}}
            @if($user->roles->contains('id', 10))
            <div class="my-3">
                <label for="members" class="form-label text-white">Inserisci i membri della tua band</label>
                <input value="{{ $user->userDetails->members }}" type="text" class="form-control @error('members') is-invalid @enderror" id="members" name="members" placeholder="Inserisci i membri..." maxlength="1024">
            </div>
            @endif

            {{-- Input dei ruoli --}}
            <div class="mb-3">
                <label class="form-label">Ruoli</label>

                <div>
                    
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
                                class="form-check-input"
                                type="checkbox"
                                id="role-{{ $role->id }}"
                                name="roles[]"
                                value="{{ $role->id }}"
                                minlength="1">
                            <label class="form-check-label" for="role-{{ $role->id }}">{{ $role->title }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            @error('roles[]')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
            <div class="row justify-content-between">
                <div class="col-auto">
                    <button class="btn btn-secondary" type="button">
                        <a class="text-white text-decoration-none" href="{{ route('admin.dashboard') }}">Annulla</a>
                    </button>
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary" type="submit">
                        Modifica +
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection