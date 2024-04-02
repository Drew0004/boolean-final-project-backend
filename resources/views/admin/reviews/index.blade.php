@extends('layouts.app')

@section('page-title', 'Reviews')

@section('main-content')
<h1>Reviews</h1>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($reviews as $review)
            <tr>
                <td>{{ $review->id }}</td>
                <td>{{ $review->firstname }}</td>
                <td>{{ $review->lastname }}</td>
                <td>{{ $review->description }}</td>
                <td>
                    <button class="btn btn-primary">
                        <a class="text-decoration-none text-white" href="{{ route('admin.reviews.show', $review) }}">Show</a>
                    </button>
                    {{-- <a href="{{ route('admin.reviews.show', $review) }}" class="btn btn-success btn-sm">View</a> --}}
                </td>

            </tr>
        @endforeach
        
    
        
    </tbody>
</table>

<table class="table">
    <thead>
        <tr>
            <th>label</th>
            <th>vote</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($user->votes as $vote)
            <tr>
                <td>{{ $vote->label }}</td>
                <td>{{ $vote->vote }}</td>
                <td>
                    {{-- <a href="{{ route('admin.reviews.show', $review) }}" class="btn btn-success btn-sm">View</a> --}}
                    {{-- <a href="{{ route('admin.reviews.show', $review) }}">View</a> --}}
                    
                    
                </td>
            </tr>
        @endforeach
        
    
        
    </tbody>
</table>
@endsection
