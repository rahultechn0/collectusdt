<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Goutte\Client;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Currency;
use Response; 
use Session; 
use File;
use Auth;
use Illuminate\Support\Facades\Hash;
use Traversable;

class DepositController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $method;
    public function __construct($method=''){
        $this->middleware('auth');
    }
    function deposit(){
        $userData     = Auth::user(); 
        $user_id      = $userData['id'];
        if($user_id == 1){
            $userlist     = User::select("fname","lname","id","registerId")->where("id", ">",1)->get();
            $currencylist = Currency::where("id", ">",0)->get();
            $lastDeposit  = Transaction::where("trans",0)->where("type","Admin Deposit")->orderBy("id","DESC")->skip(0)->take(10)->get();
            return view('deposit', compact('userData','currencylist','userlist','lastDeposit'));
        }else{
            Session::flash('message', 'You are not a Admin'); 
            Session::flash('alert-class', 'alert-danger');
            return redirect()->route('dashboard');
        }
    } 
    
    function saveDeposit( Request $request){
        $formData     = $request->all(); 
        $userData     = Auth::user(); 
        $user_id      = $userData['id'];     
        if($user_id == 1){
            Transaction::create( ["type"=>"Admin Deposit", "trans"=>0,"currency_id"=>$formData['currency_id'],"user_id"=>$formData['user_id'],"amount"=>$formData['amount'] ] );
            Session::flash('message', 'Successfully amount deposit'); 
            Session::flash('alert-class', 'alert-success');
            return redirect()->route('deposit');
        }else{
            Session::flash('message', 'You are not a Admin'); 
            Session::flash('alert-class', 'alert-danger');
            return redirect()->route('dashboard');
        }        
    }  
    function failedDeposit($id){
        $userData     = Auth::user(); 
        $user_id      = $userData['id'];     
        if($user_id == 1){
            Transaction::where("id",$id)->update( ["status"=>"Failed"] );
            Session::flash('message', 'Successfully Cancel deposit amount'); 
            Session::flash('alert-class', 'alert-success');
            return redirect()->route('deposit');
        }else{
            Session::flash('message', 'You are not a Admin'); 
            Session::flash('alert-class', 'alert-danger');
            return redirect()->route('dashboard');
        }
    } 
    
}
