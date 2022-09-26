<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fname',
        'lname',
        'email',"username",
        'password',
        'parent_id','parent_str','registerId','session_id','levelCount'
    ];

    public static function rules($id = 0) {
        $rules = [
            "fname" => "required",
            "username" => "required | unique:users",
            "email" => "required | unique:users",
            'password' => [
                'required',
                'string',
                'min:6',             // must be at least 6 characters in length
                /*
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
                */
                
            ],

            "cpassword" => ["required",'same:password'],
        ];

        return $rules;
    }

    public static function messages ($id = 0){
        $messages = [
            "fname.required" => "Please enter first name.",
            "email.required" => "Please enter eamil address",
            "username.required" => "Please enter username",
            "username.unique" => "Username already exists",
            "cpassword.same" => "Password and confirm password not matched",
            "cpassword.required" => "Please enter confirm password.",
        ];
        return $messages;
    }

    public static function changePasswordrules($id = 0) {
        $rules = [
            "oldPass" => "required",
            'newPass' => [
                'required',
                'string',
                'min:8',             // must be at least 8 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
                
            ],

            "cPass" => ["required",'same:newPass'],
        ];

        return $rules;
    }

    public static function changePasswordmsg ($id = 0){
        $messages = [
            "oldPass.required" => "old password required",
            "newPass.required" => "new password required",
            "cPass.required"   => "confirm password required",
            "cPass.same"       => "New Password and confirm password not matched",
            "cPass.required"   => "Please enter confirm password.",
        ];
        return $messages;
    }
    public static function loginRules($id = 0) {
        $rules = [
            "email" => "required",
            'password' =>'required'
        ];

        return $rules;
    }

    public static function loginMessages($id = 0){
        $messages = [
            "email.required" => "Please enter eamil address",
            "password.required" => "Please enter password.",
        ];
        return $messages;
    }

    public static function forgotRules($id = 0) {
        $rules = [
            "email" => "required|email"
        ];
        return $rules;
    }

    public static function forgotMessages($id = 0){
        $messages = [
            "email.required" => "Please enter eamil address"
        ];
        return $messages;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function totalRoi($userId,$id){
        $totalRoi  = Transaction::where("from_package",$id)->where("user_id",$userId)->whereIn("trans",[1,4])->sum("amount");
        return $totalRoi;
    }
    public function userFIXIncome($userId){
       $packageAmt   = Transaction::where("user_id",$userId)->where("trans",0)->first(); 
        $totalRoi  = Transaction::select("amount")->where("user_id",$userId)->whereIn("trans",[1,2,3])->where("created_at",">=",$packageAmt['created_at'])->sum("amount");
        return $totalRoi;
    }
    public function userDetails(){
        return $this->belongsTo(User::class,"parent_id","id");
    }
    public function parent()
    {
        return $this->hasOne(User::class, 'id', 'parent_id');
    }
    public function totalBusiness($userId,$parent_str){
        $teamUser        = User::select("id")->where("id","!=",$userId)->where("parent_str","LIKE",$parent_str."%")->get();
        $teamBusiness    = Transaction::where("trans",0)->whereIn("user_id",$teamUser)->sum("amount");
        return $teamBusiness;
    }
}
