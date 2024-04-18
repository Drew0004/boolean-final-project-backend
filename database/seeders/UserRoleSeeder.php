<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// importo i models
use App\Models\User;
use App\Models\Role;

//support
use Illuminate\Support\Facades\DB;


class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRoles = config('userroles');
        // GENERAZIONE RANDOMICA      
        // for ($i = 0; $i < 30; $i++) { 
        //     $randomUser = User::inRandomOrder()->first();
        //     $randomRole = Role::inRandomOrder()->first();
        
        //     // Verifico se la coppia esiste già nella tabella
        //     $existigData = DB::table('user_role')
        //         ->where('user_id', $randomUser->id)
        //         ->where('role_id', $randomRole->id)
        //         ->exists();
        
        //     // Se la coppia non esiste, inserisco il nuovo dato
        //     if (!$existigData) {
        //         DB::table('user_role')->insert([
        //             ['user_id' => $randomUser->id, 'role_id' => $randomRole->id]
        //         ]);
        //     }
        // }
        foreach($userRoles as $singleUserRole){
            
            DB::table('user_role')->insert([
                [
                    'user_id' => $singleUserRole['user_id'], 
                    'role_id' => $singleUserRole['role_id'],
                ]
            ]);
        }
    }
}
