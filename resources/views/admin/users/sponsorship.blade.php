@extends('layouts.app')
@section('page-title', 'Dashboard')

@section('main-content')
<div class="container py-5">
    <form id="payment-form" action="{{ route('admin.sponsorship.store') }}" method="post">
        @csrf
        <select class="form-select" aria-label="Default select example " id="sponsor" name="sponsor" required>
        @foreach ($sponsors as $singleSponsor)
            <option value="{{ $singleSponsor->id }}">{{ $singleSponsor->type }}</option>
        @endforeach
        </select>
        <div id="dropin-container"></div>
        <input type="submit" value="Submit Payment" />
        <input type="hidden" id="nonce" name="payment_method_nonce" />
    </form>
</div>

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