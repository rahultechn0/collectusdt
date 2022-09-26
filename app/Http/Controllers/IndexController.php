<?php
namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Currency;
use App\Models\Loginhistory;
use App\Models\Package;
use App\Models\Transaction;
use App\Models\Depositaddress;
use App\Models\Currencylist;
use Session;
use Auth;
use Response;
use Illuminate\Support\Facades\Hash;




class IndexController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $method;

    public function __construct($method=''){
    }
    function index(){
        $currencylists    = Currencylist::orderBy("id","DESC")->skip(0)->take(6)->get();
        return view('index',compact('currencylists'));
    }
	function faq(){
        return view('faq');
    }
    function login(){
        return view('login');
    }
    function forgotPassword(){
        return view('forgot-password');
    }
    function forgotPassword_2(Request $request){
        $formData   = $request->all();
        $request->validate(User::forgotRules(), User::forgotMessages());
        print_r($formData);
    }
    function register($registerId = null ){
        
        return view('registration',compact('registerId'));
    }
    public function ipnurl(Request $request){
      
        $updated_date = date("Y-m-d H:i:s");
        $api =json_encode($_POST,true);
        file_put_contents("public/test.txt",json_encode($_POST,true).$updated_date,FILE_APPEND);
        $private_hash    = $request['private_hash'];
        if($private_hash){
            $curl = curl_init();
              curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://paykassa.pro/sci/0.4/index.php?sci_confirm_order',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => array('sci_id' => '15852','sci_key' => '6upGEi2WDoO5ZNmJeAS1r2CVj19IkUR0','func' => 'sci_confirm_order','test' => 'false','private_hash' => $private_hash),
              CURLOPT_HTTPHEADER => array(
                'Cookie: __ddg1_=xKmx740mhJ831Dl2eIl0; lng=en'
              ),
            ));

             $response = curl_exec($curl);
             curl_close($curl);
            
            $res=json_decode($response,true);
           
            
            $amount   = $res['data']['amount']; 
            $tx_id    = $res['data']['hash'];
            $system    =$res['data']['system'];
            $walletaddress    =$res['data']['address'];
            $currencyData = Currency::select("id")->where("system",$system)->first();        
            
            //if($status==100 && $currencyData){
            $packageData = Package::where("id",1)->first();
            $investAmt   = $amount;
            $getId       = Depositaddress::select("user_id")->where("wallet_address",$walletaddress)->first();
            $userData    = User::select("id","parent_id")->where("id",$getId['user_id'])->first(); 
            $user_id     = $userData['id'];
            $parent_id   = $userData['parent_id'];
            if($amount >=1){
                ////Package Invest
                Depositaddress::where("user_id",$user_id)->where("wallet_address",$walletaddress)->update( ["status" =>'success'] );
                
                $data   = Transaction::create([
                    "packageId"=>$packageData['id'],
                    "currency_id"=> $currencyData['id'],
                    "user_id"=>$user_id,
                    "amount"=>$investAmt,
                    "roi_per"=>$packageData['dailyRoi'],
                    "roi_max"=>$packageData['days'],
                    "trans"=>0,
                    "type"=>"Package Invest",
                    "trans_id"=>$tx_id,
                    "api"=>$response
                ]);
                User::where("id",$user_id)->update( ["packageAmt" =>$investAmt] );
                $transId  = $data->id;

                ///Referral Bonus            
                if($parent_id > 0){
                    $packageAmt  = Transaction::select("amount")->where("user_id",$parent_id)->where("trans",0)->sum("amount"); 
                    if($packageAmt > 0){ 
                        $getIncomeYet = User::userFIXIncome($parent_id);
                        $incomeLimit  = $packageAmt*2.6;
                        $referralAmt  = $investAmt*0.07;
                        $diff         = $incomeLimit - $getIncomeYet;
                        if($referralAmt>$diff){
                            $referralAmt  = $diff;
                        }
                        if($referralAmt>0){
                            Transaction::create([
                                "user_id"    => $parent_id,
                                "refrall_id" => $user_id,
                                "currency_id"=> $currencyData['id'],
                                "amount"     => $referralAmt,
                                "trans"=>3,
                                "from_package"=>$transId,
                                "type"=>"Referral Bonus"
                            ]); 
                        }
                    }
                    
                }
            }
        }        
    } 

  
    public function logout(Request $request) { 
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();      
        return redirect('index');
    } 
    function registerFrm(Request $request){
        
        $formData   = $request->all();
        $registerId = strtolower(strtoupper($formData['registerId']));
        if($registerId ==""){
            $registerId = "00000001";
        }
        $request->validate(User::rules(), User::messages());
        $password= Hash::make($formData['password']); 
        $referralCheck  = User::where("username",$registerId)->count();
        if( $referralCheck ==1 ){
            $referralData   = User::select("id","parent_str")->where("username",$registerId)->first();
            $parent_id      = $referralData->id;
            $parent_str     = $referralData->parent_str;
            //Genrate referral id
            $new_registerId     = rand(10000000,99999999);
            $new_referralCheck  = User::where("registerId",$new_registerId)->count();
            if($new_referralCheck !=0){
                $new_registerId = rand(10000000,99999999);
            }
            
            $insert           = User::create( ["username"=>$formData['username'],"registerId"=>$new_registerId, "parent_id"=>$parent_id, "fname"=>$formData['fname'],"email"=>$formData['email'],"password"=>$password] );
            $userId           = $insert->id;
            $new_parent_str   = $parent_str.$userId.",";
            User::where("id",$userId)->update( ["parent_str" =>$new_parent_str ] );

            $email         = strtolower(strtoupper($formData['email']));
            $request->validate(User::loginRules(), User::loginMessages());
            $findCheck = User::where("email",$email)->orWhere("username",$email)->first();
            if($findCheck){
            if($findCheck->status !=1){
                Session::flash('message', 'Your are blocked'); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('login');
            }
            Auth::attempt(['email' => $email, 'password' => $formData['password']]);
            
            if ( Auth::check() ) {
                $session_id = Session::getId();
                User::where("id",$findCheck->id)->update( ["session_id"=>$session_id] );
                Loginhistory::create([ "user_id"=>$findCheck->id , "last_login_at" => $request->getClientIp() ]);
                Session::flash('message', 'Login successfully'); 
                Session::flash('alert-class', 'alert-success');
                return redirect()->route('dashboard');
            }else{
                Auth::attempt(['username' => $email, 'password' => $formData['password']]);
                if ( Auth::check() ) {
                    $session_id = Session::getId();
                    User::where("id",$findCheck->id)->update( ["session_id"=>$session_id] );
                    Loginhistory::create([ "user_id"=>$findCheck->id , "last_login_at" => $request->getClientIp() ]);
                    Session::flash('message', 'Login successfully'); 
                    Session::flash('alert-class', 'alert-success');
                    return redirect()->route('dashboard');
                }else{
                    Session::flash('message', 'Login details are mismatched'); 
                    Session::flash('alert-class', 'alert-danger');
                    return redirect()->route('login');
                }                
            }

                            
        }else{
            Session::flash('message', 'Email address not matched'); 
            Session::flash('alert-class', 'alert-danger');
            return redirect()->route('login');
        } 
            
            Session::flash('message', 'Registration successfully done'); 
            Session::flash('alert-class', 'alert-success');


            return redirect()->route('login');
        }else{
            Session::flash('message', 'Sponser id not registered'); 
            Session::flash('alert-class', 'alert-danger');
            return redirect()->route('register');
        }
    }
    public function loginIn(Request $request ) {
        $formData      = $request->all();
        $email         = strtolower(strtoupper($formData['email']));
        $request->validate(User::loginRules(), User::loginMessages());
        $findCheck = User::where("email",$email)->orWhere("username",$email)->first();
        if($findCheck){
            if($findCheck->status !=1){
                Session::flash('message', 'Your are blocked'); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('login');
            }
            Auth::attempt(['email' => $email, 'password' => $formData['password']]);
            
            if ( Auth::check() ) {
                $session_id = Session::getId();
                User::where("id",$findCheck->id)->update( ["session_id"=>$session_id] );
                Loginhistory::create([ "user_id"=>$findCheck->id , "last_login_at" => $request->getClientIp() ]);
                Session::flash('message', 'Login successfully'); 
                Session::flash('alert-class', 'alert-success');
                return redirect()->route('dashboard');
            }else{
                Auth::attempt(['username' => $email, 'password' => $formData['password']]);
                if ( Auth::check() ) {
                    $session_id = Session::getId();
                    User::where("id",$findCheck->id)->update( ["session_id"=>$session_id] );
                    Loginhistory::create([ "user_id"=>$findCheck->id , "last_login_at" => $request->getClientIp() ]);
                    Session::flash('message', 'Login successfully'); 
                    Session::flash('alert-class', 'alert-success');
                    return redirect()->route('dashboard');
                }else{
                    Session::flash('message', 'Login details are mismatched'); 
                    Session::flash('alert-class', 'alert-danger');
                    return redirect()->route('login');
                }                
            }

                            
        }else{
            Session::flash('message', 'Email address not matched'); 
            Session::flash('alert-class', 'alert-danger');
            return redirect()->route('login');
        }
    } 
 
    function getFullname(Request $request){ 
        $formData       = $request->all();
        $registerId     = $formData['registerId'];
        $referralCheck  = User::select("fname")->where("username",$registerId)->first();
        if($referralCheck){
            return Response::json(array('type' => "success", 'msg' => "Sponser name- ".$referralCheck['fname'] ));
        }else{
            return Response::json(array('type' => "danger", 'msg' => "Sponsor Id not valid." ));
        }         
        
    }
    
}
