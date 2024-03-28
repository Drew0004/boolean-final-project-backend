@extends('layouts.app')

@section('page-title', 'Edit project')

@section('main-content')
  <div>
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
        {{-- <form action="{{ route('admin.users.update')}}" method="POST" enctype="multipart/form-data"> --}}
            @csrf
            @method('PUT')
            
            {{-- Input del nome utente --}}
            <div class="my-3">
                <label for="username" class="form-label text-white">Nome*</label>
                <input value="{{ $user->name }}" type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Inserisci il Nome..." maxlength="255" required>
            </div>

            {{-- Input della città --}}
            <div class="my-3">
                <label for="city" class="form-label text-white">Città*</label>
                <input value="{{ $user->city }}" type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" placeholder="Inserisci la città..." maxlength="255" required>
            </div>

            {{-- Input della demo --}}
            <div class="my-3">
                <label for="demo" class="form-label text-white">Carica una demo!</label>
                <input class="form-control @error('demo') is-invalid @enderror" type="file" id="demo" name="demo">

                @if ($user->userDetails->demo != null)
                <div class="mt-2">
                    <h4 class="text-white">
                        Demo Attuale:
                    </h4>
                    {{-- <img src="/storage/{{ $project->cover_img }}" style="max-width: 200px;"> --}}
                    Demo da inserire
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="delete_demo" name="delete_demo">
                        <label class="form-check-label" for="delete_demo">
                            Rimuovi demo
                        </label>
                    </div>
                </div>
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
            <div class="my-3">
                <label for="members" class="form-label text-white">Se sei in una band, inserisci i membri</label>
                <input value="{{ $user->userDetails->members }}" type="text" class="form-control @error('members') is-invalid @enderror" id="members" name="members" placeholder="Inserisci i membri..." maxlength="1024">
            </div>
            <button class="btn btn-primary" type="submit">
                Modifica +
            </button>
        </form>
    </div>
@endsection