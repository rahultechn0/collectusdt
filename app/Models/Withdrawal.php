<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $guarded = [];
    /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	*/
	protected $fillable = [
		'user_id', 'currency_id','wallet_address','amount','remark','trans_id','trans','status','curl_response','checkCount',"tdsAmt",'system','fees'];
		
   public function user(){
         return $this->belongsTo(User::class);
    }

    public function currency(){
         return $this->belongsTo(Currency::class);
    }
}
