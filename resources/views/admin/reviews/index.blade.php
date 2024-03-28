@extends('layouts.app')

@section('page-title', 'Reviews')

@section('main-content')
<h1>Reviews</h1>
<a href="{{ route('admin.reviews.create') }}" class="btn btn-primary mb-3">Create Review</a>
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
                    <a href="{{ route('admin.reviews.show', $review) }}" class="btn btn-success btn-sm">View</a>
                    <a href="{{ route('admin.reviews.edit', $review) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
