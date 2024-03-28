@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('main-content')
    <div class="container">
        <h1>Review Details</h1>
        <div>
            <p><strong>First Name:</strong> {{ $review->firstname }}</p>
            <p><strong>Last Name:</strong> {{ $review->lastname }}</p>
            <p><strong>Description:</strong> {{ $review->description }}</p>
        </div>
    </div>
@endsection
