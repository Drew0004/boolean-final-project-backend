@extends('layouts.app')

@section('page-title', 'Reviews')

@section('main-content')
<style>
    #reviews .hero-section {
        background-image: url('{{ asset("storage/".$user->userDetails->picture) }}');
        min-height: 400px;
        background-size: cover;
        background-position: 0 40%; 
    }
  </style>
  <section id="reviews">
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
            <h2 class="pt-5">
                Le tue recensioni:
            </h2>
        </div>

        <div class="container">
            {{-- Sezione reviews --}}
            <div class="row justify-content-between">
                @if(!$reviews->isEmpty())
                @foreach($reviews as $review)
                <div class="col-5 my-5 my-review-card p-4">
                    <div class="review-upper-card">
                        {{-- Info utente --}}
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-envelope text-white me-2"></i>
                                <h4 class="text-white m-0">{{ $review->firstname }} {{ $review->lastname }}</h4>
                            </div>
                            <h5 class="text-white m-0">{{ $review->created_at }}</h5>
                        </div>
                    </div>

                    <div class="review-middle-card">
                        {{-- Contenuto review --}}
                        <p class="text-white">{{ $review->description }}</p>
                    </div>
                    <div class="review-lower-card">
                        <div class="d-flex justify-content-end">
    
                            {{-- Bottone show --}}
                            <a href="{{ route('admin.reviews.show', ['review' => $review->id]) }}" class="text-decoration-none">
                                <i class="fa-solid fa-arrow-right text-white"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
                
                @else
                <div class="text-center">
                    <h2 class="badge text-bg-danger fs-4 mb-5">Ops! Sembra che tu non abbia ancora ricevuto Recensioni!</h2>
                </div>
                @endif

            </div>
            
            <h2 class="py-5">
                Le tue votazioni:
            </h2>

            {{-- Sezione Voti --}}
            <div class="row justify-content-between pb-5">
                @if(!$user->votes->isEmpty())
                @foreach($user->votes as $vote)
                <div class="col-4 my-4">
                    <div class="vote-card p-4">
                        <h4 class="text-white pb-3 fw-bold m-0">{{ $vote->label }}</h4>
                        <div class="row g-0">
                            @if (intval($vote->vote) >= 1 && intval($vote->vote)  <= 5)
                                @for ($i = 0; $i < intval($vote->vote) ; $i++)
                                    <div class="vote-circle me-3"></div>
                                @endfor
                            @endif
                        </div>
                        {{-- <div class="vote-circle"></div> --}}
                    </div>
                </div>
                @endforeach
                @else
                <div class="text-center">
                    <h2 class="badge text-bg-danger fs-4 mb-5">Ops! Sembra che tu non abbia ancora ricevuto Votazioni!</h2>
                </div>
                @endif
            </div>
        </div>
  </section>
@endsection
{{-- <h1>Reviews</h1>

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
            </tr>
        @endforeach
        
    
        
    </tbody>
</table> --}}
