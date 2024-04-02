@extends('layouts.app')

@section('page-title', 'Tutti i messaggi')

@section('main-content')
    <div class="row">
        <div class="col">
            
            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Cognome</th>
                            <th scope="col">email</th>
                            <th scope="col">Data di invio</th>
                            <th scope="col">messaggio ricevuto</th>
                            <th scope="col" colspan="3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($receivedMessages as $message)
                            <tr>
                                <td>{{ $message->firstname }}</td>
                                <td>{{ $message->lastname }}</td>
                                <td>{{ $message->email }}</td>
                                <td>{{ $message->created_at }}</td>
                                <td>{{ $message->message }}</td>
                                <td>
                                    <a href="{{ route('admin.messages.show', ['message' => $message->id]) }}" class="btn btn-xs btn-primary">
                                        Show
                                    </a>
                                </td>

                                <td>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="offcanvas"
                                    data-bs-target="#deleteConfirmation{{ $message->id , $message->firstname }}">
                                    Archivia
                                    </button>

                                    <div class="offcanvas offcanvas-end d" tabindex="-1"
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
                                                <button type="submit" class="btn btn-danger">Conferma archiviazione</button>
                                            </form>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Modale per messaggi con soft delete --}}

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Visualizza messaggi archiviati
                </button>
                
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
                            <ul class="list-unstyled border">
                                <li><strong>Id:</strong> {{ $singleDeletedMessage->id}}</li>
                                <li>
                                    <strong>Nome:</strong> {{ $singleDeletedMessage->firstname }}
                                </li>
                                <li>
                                    <strong>Cognome:</strong> {{ $singleDeletedMessage->lastname }}
                                </li>
                                <li>
                                    <strong>Messaggio:</strong> {{ $singleDeletedMessage->message }}
                                </li>
                                {{-- Bottone Recupero --}}
                                <li>
                                    <form class="mt-5" id="restoreForm{{ $singleDeletedMessage->id }}"
                                        action="{{ route('admin.messages.restore', ['message' => $singleDeletedMessage->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-primary">Recupera</button>
                                    </form>
                                </li>
                                {{-- Bottone eliminazione definitiva --}}
                                <li>
                                    <form
                                    onsubmit="return confirm('Sei sicuro di voler eliminare questo Messaggio?');"
                                    action="{{ route('admin.messages.forcedelete', ['message' => $singleDeletedMessage->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            Elimina
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        @endforeach
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection