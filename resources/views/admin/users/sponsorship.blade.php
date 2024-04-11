@extends('layouts.app')
@section('page-title', 'Dashboard')

@section('main-content')

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
            <h2 class="text-white">Qualcosa è andato storto!</h2>
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