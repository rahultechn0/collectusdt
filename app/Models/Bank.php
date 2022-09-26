<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Bank extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "user_id", "ac_name", "branch_name", "b_name", "ac_no", "ifsc_code", "address", "status"
        
    ];  

    public static function rules($id = 0) {
        $rules = [
            "b_name"    => "required",
            "ac_no"     => "required|numeric",
            "ac_name"   => "required",
            "ifsc_code" => "required",
            "address" => "required",
            "branch_name" => "required",
             
        ];

        return $rules;
    }

    public static function messages ($id = 0){
        $messages = [
            "b_name.required"  => "Please enter bank name.",
            "ac_no.required"   => "Please enter account no",
            "ac_name.required" => "Please enter account holder name ",
            "ifsc_code.required" => "Please enter ifsc code name",
            "branch_name.required" => "Please enter branch name",
            "address.required" => "Please enter address",
        ];
        return $messages;
    }

}
