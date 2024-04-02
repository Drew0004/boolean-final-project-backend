<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//SoftDelete
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    use SoftDeletes;

    protected $casts = [
        'deleted_at' => 'datetime',
    ];
}
