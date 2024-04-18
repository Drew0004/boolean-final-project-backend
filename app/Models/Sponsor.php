<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'type',
        'hours'
    ];

    public function users(){
        return $this->belongsToMany(User::class, 'user_sponsor');
    }
}
