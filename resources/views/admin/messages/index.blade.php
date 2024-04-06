@extends('layouts.app')

@section('page-title', 'Tutti i messaggi')

@section('main-content')
<style>
    #messages .hero-section {
        background-image: url('{{ asset("storage/".$user->userDetails->picture) }}');
        min-height: 400px;
        background-size: cover;
        background-position: 0 40%; 
    }
  </style>
  <section id="messages">
        {{-- Sezione Hero Profilo --}}
        @isset($user->userDetails->picture)
        <div class="hero-section d-flex align-items-center">
        </div>
        @else
        <div class="img-not-found d-flex align-items-center">
            <div class="container">
                <h1 class="text-white fw-bold mb-0">
                    Immagine da inserire...
                </h1>
            </div>
        </div>
        @endisset

        {{-- Sezione Dati --}}
        <div class="container">
            <h2 class="py-5">
                I tuoi messaggi:
            </h2>
        </div>

        {{-- Sezione messaggi --}}
        <div class="container">
            <div class="row justify-content-between">

                @foreach($receivedMessages as $message)
                <div class="col-5 my-5 my-message-card p-4">
                    <div class="message-upper-card">
                        {{-- Info utente --}}
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-envelope text-white me-2"></i>
                                <h4 class="text-white m-0">{{ $message->firstname }} {{ $message->lastname }}</h4>
                            </div>
                            <h4 class="text-white m-0">{{ $message->email }}</h4>
                            <h5 class="text-white m-0">{{ $message->created_at }}</h5>
                        </div>
                    </div>

                    <div class="message-middle-card">
                        {{-- Contenuto messaggio --}}
                        <p class="text-white">{{ $message->message }}</p>
                    </div>
                    <div class="message-lower-card">
                        <div class="d-flex justify-content-between">
                            {{-- Bottone archiviazione con offcanva --}}
                            <button type="button" class="invisible-btn" data-bs-toggle="offcanvas"
                            data-bs-target="#deleteConfirmation{{ $message->id , $message->firstname }}">
                            <i class="fa-solid fa-trash-can text-white"></i>
                            </button>
                            {{-- Contenuto offcanva --}}
                            <div class="offcanvas offcanvas-end" tabindex="-1"
                                id="deleteConfirmation{{ $message->id , $message->firstname }}">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="deleteConfirmationLabel{{ $message->id , $message->firstname }}">
                                        Conferma archiviazione
                                    </h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                        aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                    <p>Vuoi davvero Archiviare il messaggio di <h5 class=" d-inline-block ">{{ $message->firstname }} {{ $message->lastname }}?</h5></p>
                                    <form class="mt-5" id="deleteForm{{ $message->id }}"
                                        action="{{ route('admin.messages.destroy', ['message' => $message->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><span>Conferma archiviazione</span></button>
                                    </form>
                                </div>
                            </div>
    
                            {{-- Bottone show --}}
                            <a href="{{ route('admin.messages.show', ['message' => $message->id]) }}" class="text-decoration-none">
                                <i class="fa-solid fa-arrow-right text-white"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            {{-- Modale per messaggi con soft delete --}}

            <!-- Button trigger modal -->
            <div class="col-auto text-center py-5">
                <button type="button" class="text-center btn modal-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <span>Visualizza messaggi archiviati</span>
                </button>
            </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Messaggi archiviati</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    {{-- Contenuto Modal --}}
                    <div class="modal-body">
                        {{-- Singolo messaggio --}}
                        @foreach($softDeletedMessages as $singleDeletedMessage)
                        <div class="list-unstyled modal-card my-3">
                            <div class="text-white"><strong>Id:</strong> {{ $singleDeletedMessage->id}}</div>
                            <div class="text-white">
                                <strong>Nome:</strong> {{ $singleDeletedMessage->firstname }}
                            </div>
                            <div class="text-white">
                                <strong>Cognome:</strong> {{ $singleDeletedMessage->lastname }}
                            </div>
                            <div class="text-white">
                                <strong>Messaggio:</strong> {{ $singleDeletedMessage->message }}
                            </div>
                            <div class="d-flex justify-content-between my-2">
                                {{-- Bottone eliminazione definitiva --}}
                                <div>
                                    <form
                                    onsubmit="return confirm('Sei sicuro di voler eliminare questo Messaggio?');"
                                    action="{{ route('admin.messages.forcedelete', ['message' => $singleDeletedMessage->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                        <button type="submit" class="btn btn-danger rounded-5">
                                            Elimina
                                        </button>
                                    </form>
                                </div>
                                {{-- Bottone Recupero --}}
                                <div>
                                    <form id="restoreForm{{ $singleDeletedMessage->id }}"
                                        action="{{ route('admin.messages.restore', ['message' => $singleDeletedMessage->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-primary rounded-5">Recupera</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
                </div>
            </div>
        </div>
  </section>
  @endsection