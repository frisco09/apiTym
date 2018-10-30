<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class file extends Model
{
    protected $fillable = [
        'name',  'type', 'extension', 'user_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
