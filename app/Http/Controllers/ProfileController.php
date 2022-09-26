<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Loginhistory;
use App\Models\Withdrawal;
use App\Models\Transaction;
use App\Models\Rank;
use App\Models\Wallet;
use Response; 
use Session;  
use Auth;
use Illuminate\Support\Facades\Hash;


class ProfileController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $method;
    public function __construct($method=''){
        $this->middleware('auth');
    }
    function network(){
		$userData     = Auth::user(); 
        $user_id      = $userData['id'];
        $parent_str   = $userData['parent_str'];

        $levelArr    = [];
        $addStrin    = "+[0-9]+,";          
        $addStrin1   = "";
        for($i=1;$i<11; $i++){
            $addStrin1  .= $addStrin;   
            $levelCnt    = User::select("id")->whereRaw(" parent_str REGEXP '^".$parent_str.$addStrin1."$'")->count();
            array_push( $levelArr,$levelCnt);
        }
        $teamSize     = User::select("id")->where("id",">",$user_id)->where("parent_str","LIKE", $parent_str."%")->get();
        $teamBusiness = Transaction::select("amount")->whereIn("user_id",$teamSize)->where("trans",0)->sum("amount");
        $totalUser    = [];///User::select("id","registerId","parent_id","created_at","parent_str","fname","lname")->where("id","!=",$user_id)->where("parent_str","LIKE",$userData['parent_str']."%")->get();
        return view('network', compact('userData',"teamSize","teamBusiness","levelArr","totalUser"));
    }
    function getTeamInfo( Request $request){
        $userData     = Auth::user(); 
        $user_id      = $userData['id'];  
        $parent_str   = $userData['parent_str'];  
        $formData     = $request->all();
        $levelNo      = $formData['levelNo']+1;
        $addStrin    = "+[0-9]+,";          
        $addStrin1   = "";
        for($i=1;$i<$levelNo; $i++){
            $addStrin1  .= $addStrin; 
        }
        $users       = User::select("id","fname","username","parent_id","created_at")->whereRaw(" parent_str REGEXP '^".$parent_str.$addStrin1."$'")->get();
        $returnHTML  = view('render.team-details')->with('users', $users)->render();

        return response()->json(array('type' => "success", 'table'=>$returnHTML));

    }
    function levelIncome(){
        $userData    = Auth::user();
        $user_id     = $userData->id;        
        $levelTrans  = Transaction::select('type')->where("user_id",$user_id)->where("trans",2)->groupBy('type')->selectRaw('sum(amount) as amount, type')->get();
        //Level user count
        $parent_str  = $userData->parent_str;
        $levelArr    = [];
        $addStrin    = "+[0-9]+,";          
        $addStrin1   = "";
        for($i=1;$i<11; $i++){
            $addStrin1  .= $addStrin;   
            $levelUsers  = User::select("id")->whereRaw(" parent_str REGEXP '^".$parent_str.$addStrin1."$'")->get();
            $business    = Transaction::select("amount")->where("trans",0)->whereIn("user_id",$levelUsers)->sum("amount");
            array_push( $levelArr,[ "levelCnt"=>count($levelUsers),"business"=>$business ]);
        }        
        return view('levelIncome',compact('userData','levelTrans',"levelArr"));
    }
    function levelReport(){
        $userData    = Auth::user();
        $user_id     = $userData->id;        
        $levelTrans  = Transaction::select('type',"user_id","amount","id","created_at","currency_id")->where("trans",2)->get();              
        return view('levelReport',compact('userData','levelTrans'));
    }
    function referralReport(){
        $userData    = Auth::user();
        $user_id     = $userData->id;        
        $levelTrans  = Transaction::select('type',"user_id","amount","id","created_at","currency_id")->where("trans",3)->get();              
        return view('referralReport',compact('userData','levelTrans'));
    }
    function stakIncome(){
        $userData    = Auth::user();
        $user_id     = $userData->id;        
        $levelTrans  = Transaction::select('type',"user_id","amount","id","created_at","currency_id","from_package")->where("user_id",$user_id)->where("trans",1)->get();

        return view('stakIncome',compact('userData','levelTrans'));
    }
    function referralIncome(){
        $userData    = Auth::user();
        $user_id     = $userData->id;        
        $levelTrans  = Transaction::select('type',"user_id","amount","id","created_at","currency_id","refrall_id","from_package")->where("user_id",$user_id)->where("trans",3)->get();              
        return view('referralIncome',compact('userData','levelTrans'));
    }
    function rankIncome(){
        $userData    = Auth::user();
        $user_id     = $userData->id;        
        $ranks       = Rank::where("status",1)->get();              
        return view('rankIncome',compact('userData','ranks'));
    }
    function rankReport(){
        $userData    = Auth::user();
        $user_id     = $userData->id;        
        $levelTrans  = Transaction::select('type',"user_id","amount","id","created_at","currency_id")->where("trans",5)->get();              
        return view('rankReport',compact('userData','levelTrans'));
    }
    function withdrawHistory(){
        $userData     = Auth::user(); 
        $user_id      = $userData['id'];
        $withdrawalList = Withdrawal::select("id","user_id","currency_id","amount","wallet_address","status","created_at")->where("status","Success")->get();
        return view('withdrawHistory', compact('userData','withdrawalList'));
    }  
    function packageReport(){
        $userData    = Auth::user();
        $user_id     = $userData->id;
        $investArr   = Transaction::select("id","user_id","currency_id","amount","created_at")->where("trans",0)->orderBy("id","DESC")->get();
        return view('packageReport',compact('userData',"investArr"));
    }
    function packageHistory(){
        $userData    = Auth::user();
        $user_id     = $userData->id;
        $investArr   = Transaction::select("id","user_id","currency_id","amount","created_at","roi_max","roi_cnt","trans")->where("user_id",$user_id)->whereIn("trans",[0,8])->orderBy("id","DESC")->get();
         $totalincome  = Transaction::where("user_id",$user_id)->whereIN("trans", array(1,2,3))->sum("amount"); 
         //print_r($totalincome);die("hello");     
        return view('package-history',compact('userData',"investArr",'totalincome'));
    }
    function userlist(){
        $userData     = Auth::user(); 
        $user_id      = $userData['id'];
        $userlist     = User::where("id",">",$user_id)->orderBy("id","DESC")->get();
       
        return view('userlist', compact('userData','userlist'));
    }
    function account(){
        $userData     = Auth::user(); 
        $user_id      = $userData['id'];
        $loginhistory = Loginhistory::where("user_id",$user_id)->orderBy("id","DESC")->skip(0)->take(5)->get();
        $walletaddressDataerc     = Wallet::where("user_id",$user_id)->where("currency_id",2)->first();
        $walletaddressDatatrc     = Wallet::where("user_id",$user_id)->where("currency_id",1)->first();
        $walletaddressDatabep     = Wallet::where("user_id",$user_id)->where("currency_id",3)->first();
        return view('account', compact('userData','loginhistory','walletaddressDataerc','walletaddressDatatrc','walletaddressDatabep'));
    }

    function saveProfile( Request $request){
        Session::flash('div_account', 'profile');
        $formData     = $request->all();
        $userData     = Auth::user(); 
        $user_id      = $userData['id'];     
        User::where("id",$user_id)->update( ["fname"=>$formData['fname'] ] );   
        Session::flash('message', 'Successfully updated profile section...'); 
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('account');
    } 
    function saveWalletAddressErc20( Request $request){
        
        Session::flash('div_account', 'profile');
        $formData     = $request->all();
        $userData     = Auth::user(); 
        $user_id      = $userData['id']; 
        $walletaddressCheck    = Wallet::where("user_id",$user_id)->where("currency_id",$formData["erc20"])->count(); 
        if($walletaddressCheck >0){
          Session::flash('message', 'Already adddedd erc20 Address.');  
           Session::flash('alert-class', 'alert-danger');
          return redirect()->route('account');
        }else{
            Wallet::create( ["user_id"=>$user_id,"currency_id"=>$formData["erc20"], "wallet_address"=>$formData['erc20_address']]);
            Session::flash('message', 'Successfully adddedd erc20 Address.');  
           Session::flash('alert-class', 'alert-success');
          return redirect()->route('account');
        }
       
    } 

    function saveWalletAddressBep20( Request $request){
        
        Session::flash('div_account', 'profile');
        $formData     = $request->all();
        $userData     = Auth::user(); 
        $user_id      = $userData['id']; 
        $walletaddressCheck    = Wallet::where("user_id",$user_id)->where("currency_id",$formData["bep20"])->count(); 
        if($walletaddressCheck >0){
          Session::flash('message', 'Already adddedd bep20 Address.');  
           Session::flash('alert-class', 'alert-danger');
          return redirect()->route('account');
        }else{
            Wallet::create( ["user_id"=>$user_id,"currency_id"=>$formData["bep20"], "wallet_address"=>$formData['bep20_address']]);
            Session::flash('message', 'Successfully adddedd bep20 Address.');  
           Session::flash('alert-class', 'alert-success');
          return redirect()->route('account');
        }
       
    } 
    function saveWalletAddressTrc20( Request $request){
        
        Session::flash('div_account', 'profile');
        $formData     = $request->all();
        $userData     = Auth::user(); 
        $user_id      = $userData['id']; 
        $walletaddressCheck    = Wallet::where("user_id",$user_id)->where("currency_id",$formData["trc20"])->count(); 
        if($walletaddressCheck >0){
          Session::flash('message', 'Already adddedd trc20 Address.');  
           Session::flash('alert-class', 'alert-danger');
          return redirect()->route('account');
        }else{
            Wallet::create( ["user_id"=>$user_id,"currency_id"=>$formData["trc20"], "wallet_address"=>$formData['trc20_address']]);
            Session::flash('message', 'Successfully adddedd trc20 Address.');  
           Session::flash('alert-class', 'alert-success');
          return redirect()->route('account');
        }
       
    } 
    function changePassword( Request $request){
        Session::flash('div_account', 'changePassword');
        $formData     = $request->all();
        $request->validate(User::changePasswordrules(), User::changePasswordmsg());
        $userData     = Auth::user(); 
        $user_id      = $userData['id'];     
        $newPass      = Hash::make($formData['newPass']); 
        if ( !(Hash::check($formData['oldPass'], $userData['password']))) { 
            Session::flash('message', 'Old password not matched'); 
            Session::flash('alert-class', 'alert-danger');
            return redirect()->route('account');
        }
        if ( (Hash::check($formData['newPass'], $userData['password']))) { 
            Session::flash('message', 'Old password or new password are matched..'); 
            Session::flash('alert-class', 'alert-danger');            
            return redirect()->route('account');
        }
        User::where("id",$user_id)->update( [ "password"=>$newPass ] );   
        Session::flash('message', 'Successfully changed password'); 
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('account');
    } 
    
    
}
