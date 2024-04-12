@extends('layouts.app')
@section('page-title', 'Dashboard')

@section('main-content')

<section id="sponsorship">
    <div class="container py-5 ">
        <div class="row">
            <!--CARD1-->
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <!--Card Top-->
                    <div class="card-top text-center mb-2 pt-3">
                        <div class="icon">
                            <i class="fa-solid fa-volume-off"></i>
                        </div>
                        <h3>Bronze</h3>
                        {{-- <h3>2.99€ / 24h </h3> --}}
                    </div>
                    <!--Card bottom-->
                    <div class="card-bottom pt-2">
                        <ul>
                            <li class="mb-2 py-2 ">
                               <h4>
                                    Costo: 2,99 €
                               </h4>
                            </li>
                            
                            <li class="mb-2 py-2 ">
                                <h4>
                                    Durata: 24 h
                               </h4> 
                            </li>
                            <li class="mb-2 py-2 ">
                                Diventa un utente sponsorizzato !
                                <br>
                                - Raggiungi il 30% in più di potenziali clienti
                                <br>
                                - Appari fra gli artisti in evidenza in homepage
                                <br>
                                - Sarai primo nelle ricerche dei nostri utenti 
                            </li>
                        </ul>
                    </div>
                </div>  
            </div>
            
            <!--CARD2-->
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="badge">
                        Most Popular
                    </div>
                    <!--Card Top-->
                    <div class="card-top text-center mb-2 pt-3">
                        <div class="icon">
                        <i class="fa-solid fa-volume-low"></i>
                    </div>
                        <h3>Silver</h3>
                    </div>
                    <!--Card bottom-->
                    <div class="card-bottom pt-2">
                        <ul>
                            <li class="mb-2 py-2 ">
                               <h4>
                                    Costo: 5,99 €
                               </h4>
                            </li>
                            
                            <li class="mb-2 py-2 ">
                                <h4>
                                    Durata: 72 h
                               </h4> 
                            </li>
                            <li class="mb-2 py-2 ">
                                Raggiungi il 40% in più di potenziali clienti apparendo nella sezione degli artisti in evidenza. 
                            </li>
                        </ul>
                    </div>
                  
                </div>  
            </div>
        
            <!--CARD3-->
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <!--Card Top-->
                    <div class="card-top text-center mb-2 pt-3">
                        <div class="icon">
                        <i class="fa-solid fa-volume-high"></i>
                    </div>
                        <h3>Gold</h3>
                    </div>
                    <!--Card bottom-->
                    <div class="card-bottom pt-2">
                        <ul>
                            <li class="mb-2 py-2 ">
                               <h4>
                                    Costo: 9,99 €
                               </h4>
                            </li>
                            
                            <li class="mb-2 py-2 ">
                                <h4>
                                    Durata: 144 h
                               </h4> 
                            </li>
                            <li class="mb-2 py-2 ">
                                Raggiungi il 50% in più di potenziali clienti apparendo nella sezione degli artisti in evidenza. 
                            </li>
                        </ul>
                    </div>
                </div>  
            </div>
        </div>
    </div>
    @if($usersWithoutSponsorship->contains($user) || !$sponsoredUser->contains($user))
<section id="forms">
    <div class="container py-5">
        <form id="payment-form" action="{{ route('admin.sponsorship.store') }}" method="post">
            @csrf
            <label class="my-label mb-3" for="sponsor">Scegli il tuo piano di sponsorizzazione</label>
            <select class="form-select" aria-label="Default select example " id="sponsor" name="sponsor" required>
            @foreach ($sponsors as $singleSponsor)
                <option value="{{ $singleSponsor->id }}">{{ $singleSponsor->type }} - {{ $singleSponsor->price }}€</option>
            @endforeach
            </select>
            <h3 class="my-label mt-4">Inserisci i dati della carta:</h3>
            <div id="dropin-container"></div>
            {{-- <input class="btn btn-primary" type="submit" value="Submit Payment" /> --}}
            <div class="text-end">
                <button class="btn login-btn" type="submit">
                    <span>Paga ora</span>
                </button>
            </div>
            <input type="hidden" id="nonce" name="payment_method_nonce" />
        </form>
    </div>
</section>
@else
<div class="container py-5 my-error-pay-form">
    {{-- <h2 class="badge text-bg-danger my-5 fs-4">Sembra che tu abbia già una sponsorizzazione attiva, potrai crearne una nuova appena quest'ultima sarà scaduta</h2> --}}
    <div class="my-error-bg d-flex flex-column align-items-center p-5 rounded-5">
        <div class="img-danger-container mb-5">
            <img src="{{ asset("storage/images/warning.png")}}" alt="Danger">
        </div>
        <div class="bg-danger p-1 rounded-4 text-center col-5 mb-5">
            <h2 class="text-white">Sponsorizzazione attiva!</h2>
        </div>
        <div class="col-5 mb-5">
            <p class="text-white text-center">Attualmente hai una sponsorizzazione attiva. Potrai attivarne una nuova solo dopo che la tua sponsorizzazione attuale sarà scaduta.</p>
        </div>
        <button class="btn my-redirect-btn">
            <a href="{{ route('admin.dashboard') }}">Torna alla Dashboard</a>
        </button>
    </div>
</div>
@endif


</section>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<script src="https://js.braintreegateway.com/web/dropin/1.30.0/js/dropin.min.js"></script>
<script>
    const form = document.getElementById('payment-form');
    
    braintree.dropin.create({
        container: '#dropin-container',
        authorization: '{{ $clientToken }}'
    }, (error, dropinInstance) => {
        if (error) console.error(error);

        form.addEventListener('submit', event => {
            event.preventDefault();

            dropinInstance.requestPaymentMethod((error, payload) => {
                if (error) console.error(error);

                document.getElementById('nonce').value = payload.nonce;
                form.submit();
            });
        });
    });
</script>
  
@endsection