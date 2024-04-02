@extends('layouts.app')

@section('page-title', 'Tutti i messaggi')

@section('main-content')
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
            <tr>
                <td>{{ $message->firstname }}</td>
                <td>{{ $message->lastname }}</td>
                <td>{{ $message->email }}</td>
                <td>{{ $message->message }}</td>
                <td>{{ $message->created_at }}</td>
                {{-- <td>
                    <div class="offcanvas-body">
                        <form class="mt-5" id="deleteForm{{ $message->id }}"
                            action="{{ route('admin.messages.destroy', ['message' => $message->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Conferma eliminazione</button>
                        </form>
                    </div>
                </td> --}}

                <td>
                    <div class="offcanvas offcanvas-end d" tabindex="-1"
                                    id="deleteConfirmation{{ $message->id , $message->email }}">
                                    <div class="offcanvas-header">
                                        <h5 class="offcanvas-title" id="deleteConfirmationLabel{{ $message->id , $message->email }}">
                                            Conferma eliminazione
                                        </h5>
                                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body">
                                        <p>Vuoi davvero eliminare il messaggio di <h5 class=" d-inline-block ">{{ $message->firstname }} {{ $message->lastname }}</h5> ?</p>
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
        </tbody>
    </table>
</div>
@endsection