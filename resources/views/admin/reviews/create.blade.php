@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('main-content')
    <div class="container">
        <h1>Create Review</h1>
        <form action="{{ route('admin.reviews.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="firstname">First Name:</label>
                <input type="text" name="firstname" class="form-control" id="firstname" required>
            </div>
            <div class="form-group">
                <label for="lastname">Last Name:</label>
                <input type="text" name="lastname" class="form-control" id="lastname" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" class="form-control" id="description" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
