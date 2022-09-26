<?php
namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Goutte\Client;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\Subscriptionrequest;
use App\Models\Wallet;
use Response; 
use Auth;
use Illuminate\Support\Facades\Hash;

class SubscriptionController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $method;
    public function __construct($method=''){
        $this->middleware('auth');
    }    
    
    function subscriptionRequest(Request $request){
        $formData       = $request->all();
        $userData       = Auth::user();
        $user_id        = $userData->id;
        $subsId         = $formData['subsId'];
        $currency_id    = 1;
        $wallets        = Wallet::select("currency_id","wallet_address","hexAddress")->where("currency_id",$currency_id)->where("user_id",$user_id)->first();
        $wallet_address = $wallets['wallet_address'];
        $currentDate    = date('Y-m-d h:i:s');
        $already        = Subscriptionrequest::where("user_id",$user_id)->orderBy("id","desc")->first();
        if( (!$already) || ($currentDate > $already['last_date']  ) ){
            $subData     = Subscription::where("id",$subsId)->first();
            $last_date   = date('Y-m-d h:i:s', strtotime($subData['period']));
            $originalAmt = $subData['amount'];
            $payAmt      = $subData['amount']-$subData['discount'];
            $balance     = Transaction::where("user_id",$user_id)->where("currency_id",$currency_id)->sum("amount");
            if($balance >= $payAmt ){
                Transaction::create( ["trans"=>1,"currency_id"=>$currency_id,"user_id"=>$user_id,"amount"=>(-$payAmt),"wallet_address"=>$wallet_address ] );
                $parent_arr   = array();
                $parent_per   = array(0.05,0.03,0.02);      
                if($userData['parent_id'])
                {
                  $parent_id    = $userData['parent_id'];
                  $user         = User::select("parent_str")->where("id",$parent_id)->first();          
                  if($user){ 
                    $parent_str = $user->parent_str;
                    $arr        = array_reverse(explode(",",rtrim($parent_str,",")));
                    $arr_cnt    = count($arr);
                    if($arr_cnt>3){
                      $arr_cnt  = 3;
                    }
                    for($i =0;$i<$arr_cnt; $i++){
                        array_push($parent_arr, $arr[$i]);  
                    }   
                  }
                }
                ///Level income
                foreach ($parent_arr as $key => $user) { 
                    if($user>0){
                      $transLevel = array( "type"=>"Level-".($key+1), "user_id"=>$user,"refrall_id"=>$user_id,"amount"=>($originalAmt*$parent_per[$key]),"trans"=>2,"currency_id"=>$currency_id  );
                      Transaction::create($transLevel); 
                    }
                }     
                Subscriptionrequest::create(["user_id"=>$user_id,"wallet_address"=>$wallet_address,"subsId"=>$subsId,"amount"=>$originalAmt,"pay_amount"=>$payAmt,"last_date"=>$last_date]);            
                $returnArr    = array("status"=>true,"msg"=>"Successfully activated");
            }else{
                $returnArr    = array("status"=>false,"msg"=>"Insufficient payment");
            }
        }else{
            $returnArr    = array("status"=>false,"msg"=>"Already activate subscription");
        }
        return Response::json( $returnArr );
    }
}
