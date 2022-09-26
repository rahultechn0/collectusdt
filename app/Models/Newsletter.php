<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Newsletter extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ 
        'news_email'
    ];

    public static function rules($id = 0) {
        $rules = [
            "news_email" => "required | unique:newsletters"
        ];

        return $rules;
    }

    public static function messages ($id = 0){
        $messages = [
            "news_email.required" => "Please enter email address",
            "news_email.unique"   => "Email address already exists."
        ];
        return $messages;
    }   
}
