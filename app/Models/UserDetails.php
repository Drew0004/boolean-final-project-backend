<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory;

    protected $fillable=[
        'demo',
        'picture',
        'bio',
        'cellphone',
        'members',
    ];

    //Relazioni fra le due tabelle One to one
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
