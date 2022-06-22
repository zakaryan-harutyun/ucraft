<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Wallet extends Model
{
    use HasFactory;

    public $fillable = ['name', 'type','user_id'];

    public function records(){

        return $this->hasMany(Record::class,'wallet_id','id');
    }

    public function user(){

        return $this->belongsTo(User::class);
    }

    /**
     * Checking auth wallets
     * It will be better to use gates
     *
     */
    public function scopeOwner($query)
    {
        return $query
            ->where('user_id', Auth::id());
    }

}
