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
                <td>
                    <div class="offcanvas-body">
                        <form class="mt-5" id="deleteForm{{ $message->id }}"
                            action="{{ route('admin.messages.destroy', ['message' => $message->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Conferma eliminazione</button>
                        </form>
                    </div>
                </td>
                
            </tr>
        </tbody>
    </table>
</div>
@endsection