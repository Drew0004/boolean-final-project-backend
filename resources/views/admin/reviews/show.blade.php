@extends('layouts.app')

@section('page-title', 'Tutti i messaggi')

@section('main-content')
<style>
    #reviews-show .hero-section {
        background-image: url('{{ asset("storage/".$user->userDetails->picture) }}');
        min-height: 400px;
        background-size: cover;
        background-position: 0 40%; 
    }
  </style>
  <section id="reviews-show">
        {{-- Sezione Hero Profilo --}}
        @isset($user->userDetails->picture)
        <div class="hero-section d-flex align-items-center bounce-in">
        </div>
        @else
        <div class="img-not-found d-flex align-items-center bounce-in">
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
                Dettaglio Recensione
            </h2>
        </div>
        <div class="my-review-card py-5 my-5">
            <div class="container">
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
                    {{-- Contenuto messaggio --}}
                    <p class="text-white fs-4 my-5">{{ $review->description }}</p>
                </div>
                <div class="review-lower-card d-flex justify-content-end">
                    <a href="{{ route('admin.reviews.index')}}" class="text-decoration-none">
                        <i class="fa-solid fa-arrow-left text-white fs-3"></i>
                    </a>
                </div>
            </div>
        </div>
  </section>
@endsection
