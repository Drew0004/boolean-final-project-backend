@extends('layouts.app')
@section('page-title', 'Dashboard')

@section('main-content')
@if($usersWithoutSponsorship->contains($user) || !$sponsoredUser->isNotEmpty())
<section id="forms">
    <div class="container py-5">
        <form id="payment-form" action="{{ route('admin.sponsorship.store') }}" method="post">
            @csrf
            <label class="my-label mb-3" for="sponsor">Scegli il tuo piano di sponsorizzazione</label>
            <select class="form-select" aria-label="Default select example " id="sponsor" name="sponsor" required>
            @foreach ($sponsors as $singleSponsor)
                <option value="{{ $singleSponsor->id }}">{{ $singleSponsor->type }}</option>
            @endforeach
            </select>
            <h3 class="my-label mt-4">Inserisci i dati della carta:</h3>
            <div id="dropin-container"></div>
            <input class="btn btn-primary" type="submit" value="Submit Payment" />
            <input type="hidden" id="nonce" name="payment_method_nonce" />
        </form>
    </div>
</section>
@else
<div class="text-center">
    <h2 class="badge text-bg-danger my-5 fs-4">Sembra che tu abbia già una sponsorizzazione attiva, potrai crearne una nuova appena quest'ultima sarà scaduta</h2>
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