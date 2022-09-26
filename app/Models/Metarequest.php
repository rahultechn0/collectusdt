<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;
use Laravel\Passport\HasApiTokens;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class Metarequest extends Authenticatable
{
    use HasApiTokens, Notifiable;
    public static $auth_id;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "trans_type", "user_id", "trans_id", "amount", "wallet_address", "status", "checkCount", "curl_response", "error_response"
    ];
             
}
