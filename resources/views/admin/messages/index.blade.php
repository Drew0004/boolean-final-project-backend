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
                                    Elimina
                                    </button>

                                <div class="offcanvas offcanvas-end d" tabindex="-1"
                                    id="deleteConfirmation{{ $message->id , $message->firstname }}">
                                    <div class="offcanvas-header">
                                        <h5 class="offcanvas-title" id="deleteConfirmationLabel{{ $message->id , $message->firstname }}">
                                            Conferma eliminazione
                                        </h5>
                                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body">
                                        <p>Vuoi davvero eliminare <h5 class=" d-inline-block ">{{ $message->firstname }} {{ $message->lastname }}</h5> ?</p>
                                        <form class="mt-5" id="deleteForm{{ $message->id }}"
                                            action="{{ route('admin.messages.destroy', ['message' => $message->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Conferma eliminazione</button>
                                        </form>
                                    </div>
                                </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection