<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Stake extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "user_id", "currency_id", "amount", "price", "apy", "lockingPeriod", "status","completeDate","unstakeDate"
    ];  
    public function userData(){
        return $this->belongsTo(User::class,"user_id","id");
    }
    public function currencyData(){
        return $this->belongsTo(Currency::class,"currency_id","id");
    }
}
