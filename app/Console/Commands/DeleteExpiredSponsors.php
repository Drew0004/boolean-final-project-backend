<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DeleteExpiredSponsors extends Command
{
    protected $signature = 'sponsors:delete-expired';

    protected $description = 'Delete expired sponsored users';

    public function handle()
    {
        $today = Carbon::now();
    
        // Seleziono le colonne user_id e sponsor_id dalla tabella pivot user_sponsor
        // dove expired_at è inferiore o uguale alla data odierna
        $expiredUserSponsorships = DB::table('user_sponsor')
            ->where('expired_at', '<=', $today)
            ->select('user_id', 'sponsor_id')
            ->get();
    
        // Elimino ogni riga associata alla sponsorizzazione scaduta
        foreach ($expiredUserSponsorships as $expiredUserSponsorship) {
            DB::table('user_sponsor')
                ->where('user_id', $expiredUserSponsorship->user_id)
                ->where('sponsor_id', $expiredUserSponsorship->sponsor_id)
                ->delete();
        }
    
        $this->info('Expired sponsorships deleted successfully.');
    }
}
