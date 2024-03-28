@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('main-content')
    <div class="container">
        <h1>Review Details</h1>
        <div>
            <p><strong>First Name:</strong> {{ $review->firstname }}</p>
            <p><strong>Last Name:</strong> {{ $review->lastname }}</p>
            <p><strong>Description:</strong> {{ $review->description }}</p>
            <p><strong>Created At:</strong> {{ $review->created_at }}</p>
            <p><strong>Updated At:</strong> {{ $review->updated_at }}</p>
        </div>
        <a href="{{ route('admin.reviews.edit', $review) }}" class="btn btn-primary">Edit</a>
        <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
@endsection
