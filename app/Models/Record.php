<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    public $fillable = ['user_id', 'wallet_id', 'type', 'amount'];

    public function wallet(){

        return $this->belongsTo(Wallet::class,'wallet_id','id');
    }

    public function scopeWithBalance(Builder $query)
    {
        // Count HasManyDeep relation
        return $query->withCount('amount');
    }
}
