<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'vote'
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }

}
