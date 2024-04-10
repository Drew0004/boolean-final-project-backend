<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSponsorRequest;
use App\Http\Requests\UpdateSponsorRequest;
use App\Models\Sponsor;
use Illuminate\Support\Facades\DB;

//models
use App\Models\User;
// Facades
use Illuminate\Support\Facades\Auth;

use Braintree\Gateway as BraintreeGateway;

// Carbon
use Carbon\Carbon;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSponsorRequest $request)
    {
        $paymentData = $request->validated();

        // Ricevi il nonce del pagamento inviato dal form
        $nonce = $request->payment_method_nonce;

        // Elaborazione del pagamento con Braintree
        $gateway = new BraintreeGateway([
            'environment' => 'sandbox',
            'merchantId' => 'mdbffrwrgt96dybh',
            'publicKey' => 'v5tspz7wrhshk62y',
            'privateKey' => 'ebb299d16269eb2697c5cba54b6f373b'
        ]);

        $result = $gateway->transaction()->sale([
            'amount' => '10.00', // Importo del pagamento
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        $user = Auth::user();

        if ($result->success) {
            
            $hoursToAdd = 0; // Default
            switch ($paymentData['sponsor']) {
                case '1': //Piano bronze
                    $hoursToAdd = 24;
                    break;
                case '2': //Piano Silver
                    $hoursToAdd = 48;
                    break;
                case '3': //Piano gold
                    $hoursToAdd = 144;
                    break;
            }

            $expiredAt = now()->addHours($hoursToAdd);

            $now = Carbon::now();

            if($user->sponsors->where('expired_at', '>', $now)->isEmpty()){
                DB::table('user_sponsor')->insert([
                    [
                        'user_id' => $user->id, 
                        'sponsor_id' => $paymentData['sponsor'],
                        'created_at' => now(),
                        'updated_at' => now(),
                        'expired_at' => $expiredAt,
                    ]
                ]);
                return redirect()->route('admin.dashboard');   
            }
            else{
                abort(403, 'Non puoi');
            }

            // $existingUser = DB::table('user_sponsor')
            // ->where('user_id', $user)
            // ->exists();

            // if(!$existingUser){

            // }
            // else{
            //     abort(403, 'Non autorizzato');
            // }

        };
    }

    /**
     * Display the specified resource.
     */
    public function show(Sponsor $sponsor)
    {
        $usersWithoutSponsorship = User::whereDoesntHave('sponsors')->get();

        $now = Carbon::now();

        $user = Auth::user();

        // $usersWithoutSponsorship = $user->whereDoesntHave('sponsors')->get();

        $sponsoredUser =  User::whereHas('sponsors', function ($query) use ($now) {
            $query->where('expired_at', '>', $now);
        })
        ->get();
        $sponsors = Sponsor::All();
        $gateway = new BraintreeGateway([
            'environment' => 'sandbox',
            'merchantId' => 'mdbffrwrgt96dybh',
            'publicKey' => 'v5tspz7wrhshk62y',
            'privateKey' => 'ebb299d16269eb2697c5cba54b6f373b'
        ]);
    
        // Assicurati che Auth::user() restituisca l'utente autenticato e che il suo braintree_customer_id sia valido
        $customerId = Auth::user()->braintree_customer_id;
    
        // Genera il token del cliente
        $clientToken = $gateway->clientToken()->generate([
            "customerId" => $customerId
        ]);
    
        return view('admin.users.sponsorship', compact('clientToken', 'sponsors', 'customerId', 'sponsoredUser', 'usersWithoutSponsorship', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sponsor $sponsor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSponsorRequest $request, Sponsor $sponsor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sponsor $sponsor)
    {
        //
    }
}
