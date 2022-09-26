<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Transaction extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "packageId", "currency_id", "user_id", "refrall_id", "amount", "from_package", "roi_per", "roi_max", "roi_cnt", "trans", "type","trans_id","api"
    ];  

    public function userData(){
        return $this->belongsTo(User::class,"user_id","id");
    }
    public function referralData(){
        return $this->belongsTo(User::class,"refrall_id","id");
    }
    public function subscriptionData(){
        return $this->belongsTo(Subscription::class,"subsId","id");
    }
    public function currencyData(){
        return $this->belongsTo(Currency::class,"currency_id","id");
    }
    public function fromPackageData(){
        return $this->belongsTo(Self::class,"from_package","id");
    }
    
}
