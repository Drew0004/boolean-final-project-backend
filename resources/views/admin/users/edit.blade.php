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
                            Modifica +
                        </button>
                    </div>
                </div>
            </form>
    </div>
</section>
@endsection