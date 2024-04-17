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
        <div class="container d-flex justify-content-between">

            <h2 class="pt-5">
                Le tue recensioni:
            </h2>


            <h2 class="py-5">
                Le tue votazioni:
            </h2>

        </div>

        <div class="container">
            {{-- Sezione reviews --}}
            <div class="row justify-content-between">
                @if(!$reviews->isEmpty())
                <div class="col-7 mb-5 my-review-container bounce-in-x">
                    @foreach($reviews as $review)
                    <div class="col-12 mb-5 my-review-card p-4">
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
                    
                </div>
                @else
                <div class="col-6 mb-5">
                    <span class="my-blue-bg p-3 rounded-4 text-white fs-4">Ops! Sembra che tu non abbia ancora ricevuto Recensioni!</span>
                </div>
                    
                @endif

                {{-- Sezione Voti --}}
                @if(!$user->votes->isEmpty())
                <div class="col-4 bounce-in-y" id="chartContainer">
                    <canvas id="myChart2"></canvas>
                </div>
                @else
                <div class="col-6 mb-5">
                    <span class="my-blue-bg p-3 rounded-4 text-white fs-4">Ops! Sembra che tu non abbia ancora ricevuto Votazioni!</span>
                </div>
                @endif

            </div>



        </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    setTimeout(function() {
        //GRAFICO A TORTA VOTAZIONI
        const ctx2 = document.getElementById('myChart2');
        const voteCounts = {!! json_encode($voteCounts) !!};
        const labels = Object.keys(voteCounts);
        const data = Object.values(voteCounts);
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Le tue votazioni',
                    data: data,
                    backgroundColor: [
                        'rgb(33, 37, 43)',  //Pessimo
                        'rgb(51, 64, 83)', //Scarso
                        'rgb(100, 113, 132)', //Nella Media
                        'rgb(46, 104, 192)', //Molto Buono
                        'rgb(128, 179, 255)', //Eccellente
                    ],
                    borderColor: [
                        'rgba(226, 226, 226, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }, 100);
</script>
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
