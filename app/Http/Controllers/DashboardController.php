<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Models\Package;
use App\Models\Currency;
use App\Models\Depositaddress;
use App\Models\Withdrawal;
use Response;
use Session;
use Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $method;
    public function __construct($method=''){
        $this->middleware('auth');

    }


    public function coinpaysuccess(Request $request){
        //$this->viewbuilder()->layout('front');
        Session::flash('message', 'Payment successfully Completed. Your balance will update soon.');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('dashboard');
    }
    public function coinpayfail(){
        Session::flash('message', 'Payment failed.');
        Session::flash('alert-class', 'alert-danger');
        return redirect()->route('dashboard');
    }
    function dashboard(){
        $userData      = Auth::user();
        $user_id       = $userData['id'];


        if($user_id==1){
            $userCount       = User::select("id")->where("status",1)->count();
            $packageCnt      = Transaction::select("id")->where("trans",0)->count();
            $packageAmt      = Transaction::select("amount")->where("trans",0)->sum("amount");
            $withAmt         = Withdrawal::select("amount")->whereIn("trans",["Success","Pending"])->sum("amount");
            $adminArr        = [ "userCount"=>$userCount,"packageCnt"=>$packageCnt,"packageAmt"=>$packageAmt,"withAmt"=>$withAmt ];
            return view('adminDashboard', compact("adminArr",'userData'));
        }else{
            $packageData     = Package::select()->where("id",1)->first();
            $currencyList    = Currency::select("name","id")->where("status",1 )->get();
            $activePackages  = Transaction::where("user_id",$user_id)->where("trans",0)->get();
            $roiIncome       = Transaction::where("user_id",$user_id)->where("trans",1)->sum("amount");
            $levelIncome     = Transaction::where("user_id",$user_id)->where("trans",2)->sum("amount");
            $referralIncome  = Transaction::where("user_id",$user_id)->where("trans",3)->sum("amount");
            $rankIncome      = Transaction::where("user_id",$user_id)->where("trans",5)->sum("amount");
            $withdrawalsum   = Withdrawal::where("user_id",$user_id)->sum("amount");
            //$expirePackages  = Transaction::where("user_id",$user_id)->where("trans",8)->count();
             $expirePackages  = Transaction::where("user_id",$user_id)->where("type","Package Invest")->orderBy("id","DESC")->first();

            $totalIncome     = $roiIncome+$levelIncome+$referralIncome+$rankIncome-$withdrawalsum;
            return view('dashboard', compact('userData'
                                ,'activePackages'
                                ,'packageData','currencyList','levelIncome','referralIncome','totalIncome',"rankIncome","expirePackages"));
        }

    }



    function wallet(){
		$userData     = Auth::user();
        $user_id      = $userData['id'];

        $currencyList = Currency::select("id","name","symbol","image","fees")->where("status",1 )->get();
        $walletArr    = [];
        foreach($currencyList as $key => $c ){
            $deposit  = Transaction::where("user_id",$user_id)->where("trans",0)->where("currency_id",$c['id'])->sum("amount");
            $roi      = Transaction::where("user_id",$user_id)->where("trans",1)->where("currency_id",$c['id'])->sum("amount");
            $level    = Transaction::where("user_id",$user_id)->where("trans",2)->where("currency_id",$c['id'])->sum("amount");
            $referral = Transaction::where("user_id",$user_id)->where("trans",3)->where("currency_id",$c['id'])->sum("amount");
            $Withdrawal = Withdrawal::where("user_id",$user_id)->where("currency_id",$c['id'])->sum("amount");
            $Withdrawalfees = Withdrawal::where("user_id",$user_id)->where("currency_id",$c['id'])->sum("fees");
            array_push($walletArr, [ "c_name"=>$c['name'],"c_id"=>$c['id'], "c_image"=>$c['image'],"deposit"=>$deposit,"roi"=>$roi,"level"=>$level,"referral"=>$referral,"Withdrawal"=>$Withdrawal,"fees" =>$Withdrawalfees ] );
        }
        return view('wallet', compact('userData','walletArr'));
	}

    function withdrawalreq(){

        $userData     = Auth::user();
        $user_id      = $userData['id'];
        $withdrawalList = Withdrawal::select("id","user_id","currency_id","amount","wallet_address","status","created_at")->where("trans",0)->orderBy("id","DESC")->get();
        return view('withdrawalreq', compact('userData','withdrawalList'));
    }



    function withdrawal(Request $request){
     $currency_id = $_POST['currencyId'];
     $userData     = Auth::user();
     $user_id      = $userData['id'];
     $walletData  = Wallet::select("id","user_id","wallet_address","currency_id")->where("currency_id",$currency_id)->where("user_id",$user_id)->count();
     if($walletData == 0){
       return Response::json(array('type' => "error", 'msg'   => "Please Add wallet Address  First" ));
        }else{
             $wallet = Wallet::select("id","user_id","wallet_address","currency_id")->where("currency_id",$currency_id)->where("user_id",$user_id)->first();
             $Currency = Currency::select("fees")->where("id",$currency_id)->first();
             $currency_fess =$Currency['fees'];
             $walletaddress = $wallet['wallet_address'];

           $roi = Transaction::where("user_id",$user_id)->where("trans",1)->where("currency_id", $currency_id)->sum("amount");
           $level    = Transaction::where("user_id",$user_id)->where("trans",2)->where("currency_id", $currency_id)->sum("amount");
           $referral = Transaction::where("user_id",$user_id)->where("trans",3)->where("currency_id", $currency_id)->sum("amount");
           $withdrawal = Withdrawal::where("user_id",$user_id)->where("currency_id", $currency_id)->sum("amount");
         $total_balance1 =$roi+$level+$referral;
         $total_balance=$total_balance1-$withdrawal;
          return Response::json(array('type' => "success", 'msg'=> "found","balance"=>$total_balance,"wallet_address"=>$walletaddress,"c_id"=>$currency_id,'c_fees'=>$currency_fess));
       }
    }

    function withdrawalapprove(Request $request){
     $id = $_POST['Id'];
     $userData     = Auth::user();
     $user_id      = $userData['id'];
     $withdrawalData  = Withdrawal::where("id",$id)->where("status",'Pending')->first();
     // print_r($withdrawalData);die("hello");
     if($withdrawalData){
        $amt = $withdrawalData['amount'];
        $wallet_address = $withdrawalData['wallet_address'];
        $currency_id = $withdrawalData['currency_id'];

        $system_id    ="";
        $currency     ='';
        if($currency_id==1){
           $system_id =  30;
           $currency='USDT';
        }
        if($currency_id==2){
           $system_id =  32;
           $currency='USDT';
        }
        if($currency_id==3){
           $system_id =  31;
           $currency='USDT';
        }
            $curl = curl_init();
             curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://paykassa.app/api/0.5/index.php',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => array('func' => 'api_payment','api_id' => '17211','api_key' => 'aKyGIK1zDYTUwMJpl360vtzcpb8rPxuA','shop' => '15852','amount' => $amt,'currency' => $currency,'system' => $system_id,'number' => $wallet_address),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            $res=json_decode($response,true);
            $error=$res['error'];
            $msg=$res['message'];
            if($error==false){
            $txid=$res['data']['txid'];
            $system=$res['data']['system'];
            Withdrawal::where("id",$id)->update( ["status"=>"Success", "trans_id"=>$txid ,"system"=>$system,"curl_response"=>$res] );
            return Response::json(array('type' => "success", 'msg'  => $msg ));
            }else{
                 return Response::json(array('type' => "error", 'msg'  => $msg ));
              }
     }
       die;
    }

    function withdrawalrequest(Request $request){
        $currency_id = $_POST['c_id'];
        $amount      = $_POST['amt'];

        if($amount<10){
            return Response::json(array('type' => "error", 'msg'   => "Minimum withdrawal 10 USDT" ));
        }
        $Currency = Currency::select("fees")->where("id",$currency_id)->first();
        $currency_fess =$Currency['fees'];
        $amount=$amount-$currency_fess;

        $wallet_address = $_POST['wallet_address'];
        $userData     = Auth::user();
        $user_id      = $userData['id'];
        $roi = Transaction::where("user_id",$user_id)->where("trans",1)->where("currency_id", $currency_id)->sum("amount");
        $level    = Transaction::where("user_id",$user_id)->where("trans",2)->where("currency_id", $currency_id)->sum("amount");
        $referral = Transaction::where("user_id",$user_id)->where("trans",3)->where("currency_id", $currency_id)->sum("amount");
        $total_balance =$roi+$level+$referral;
        $withdrawalsum = Withdrawal::where("user_id",$user_id)->where("currency_id", $currency_id)->sum("amount");
         $withdrawalfeessum = Withdrawal::where("user_id",$user_id)->where("currency_id", $currency_id)->sum("fees");
        $withdrawalableamt=$total_balance-$withdrawalsum-$withdrawalfeessum;

        if($withdrawalableamt >= $amount && $amount >0){
            $depositaddress = Withdrawal::create( ["user_id"=>$user_id,"currency_id" => $currency_id,"amount" => $amount,"wallet_address"=>$wallet_address,"fees"=>$currency_fess] );
            return Response::json(array('type' => "success", 'msg'=> "Withdraw Request Successfully Submitted!!
                                 Wait For Admin Approval ,It will be credit in your account with in 24 hours."));
        }else{
            return Response::json(array('type' => "error", 'msg'   => "Insufficient balance for withdrawal" ));
        }
    }


    function saveaddress( Request $request){
        $formData     = $request->all();
        $amt          = $formData['amt'];
        $userData     = Auth::user();
        $user_id      = $userData['id'];

        $alreadyPackage  = Transaction::select("id")->where("trans",0)->whereColumn("roi_max",">","roi_cnt")->where("user_id",$user_id)->count();
        if($alreadyPackage >0){
            Session::flash('message', 'You have already activated package right now. Please try after complete it.');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->route('dashboard');
        }

        if($amt == ""){
            Session::flash('message', 'Please Enter Amount');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->route('dashboard');
        }
        if($amt < 75){
            Session::flash('message', 'Minimum deposit amount is 75.');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->route('dashboard');
        }

        $depositAmount = array(75, 150, 300, 375, 450, 225, 600, 675, 825, 900, 975, 1050);

        if (!in_array($amt, $depositAmount)) {
            Session::flash('message', 'Deposit amount is not multiple of 75.');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->route('dashboard');
        }

         $lastPackage  = Transaction::where("type","Package Invest")->where("user_id",$user_id)->orderBy('id', 'desc')->first();
         if(!empty($lastPackage)){
         $lastPackageamt=$lastPackage['amount'];
         //print_r($lastPackageamt);die("hello");
        if($lastPackageamt > $amt){
            Session::flash('message', 'New package should be greater or equal to last package');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->route('dashboard');

        }
  }
        $currency_id  = $formData['currency'];

        $system_id    ="";
        $currency     ='';
        if($currency_id==1){
           $system_id =  30;
           $currency='USDT';
        }
        if($currency_id==2){
           $system_id =  32;
           $currency='USDT';
        }
        if($currency_id==3){
           $system_id =  31;
           $currency='USDT';
        }


        Depositaddress::where("user_id",$user_id)->where("status",'Pending')->update(["status"=>"Failed" ]);
        // print_r($depositData);die("jjj");

        $postArr   = array('sci_id' => '15852','sci_key' => '6upGEi2WDoO5ZNmJeAS1r2CVj19IkUR0','func' => 'sci_create_order_get_data','amount' => $amt,'currency' => $currency,'order_id' => '123456','comment' => 'create address','system' =>$system_id,'phone' => 'false');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://paykassa.pro/sci/0.4/index.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postArr,
            CURLOPT_HTTPHEADER => array(
                'Cookie: __ddg1_=xKmx740mhJ831Dl2eIl0; lng=en'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $res=json_decode($response,true);
        $url=$res['data']['url'];
        $address=$res['data']['wallet'];
        $currencyname=$res['data']['currency'];
        $system=$res['data']['system'];
        //echo "<pre>"; print_r($res['data']);

        //print_r($currency_id);die("aaa");
        $depositaddress = Depositaddress::create( ["user_id"=>$user_id,"currency_id" => $currency_id,"amount" => $amt,"wallet_address"=>$res['data']['wallet'],"invoice" => $res['data']['invoice'],"order_id" => $res['data']['order_id'], "system" => $res['data']['system'],"currency" => $res['data']['currency'],"url" =>$res['data']['url']] );
        Session::flash('message', 'Successfully request Send...');
        Session::flash('alert-class', 'alert-success');
        return view('makepayment', compact('url','amt','address','userData','currencyname','system'));

    }
    function getCurrencyprice(Request $request){
        $formData      = $request->all();
        $currency_id   = $formData['currency_id'];
        $currencyData  = Currency::where("id",$currency_id)->select("id","name","price")->first();
        if( $currencyData){
            $userData     = Auth::user();
            $user_id      = $userData['id'];
            if($user_id>0){
                $balance = Transaction::where("user_id",$user_id)->where("currency_id",$currency_id)->where("status","Success")->sum("amount");

                return Response::json(array('type' => "success", 'msg'=> "found","balance"=>(int)$balance,"c_name"=>$currencyData['name'] ));
            }else{
                return Response::json(array('type' => "error", 'msg'   => "Please login first" ));
            }

        }else{
            return Response::json(array('type' => "error", 'msg'   => "Some error occure" ));
        }

    }



    function referralTeam(){
        $userData     = Auth::user();
        $user_id      = $userData['id'];
        $teamData     = User::select("fname","lname","email","registerId","created_at")->where("parent_id",$user_id)->get();
        return view('referral-team', compact('userData','teamData'));
    }
    function referralIncome(){
        $userData     = Auth::user();
        $user_id      = $userData['id'];
        $levelIncome  = Transaction::where("user_id",$user_id)->where("trans",2)->get();
        return view('referral-income', compact('userData','levelIncome'));
    }


    function walletHistory(){
		$userData     = Auth::user();
        $user_id      = $userData['id'];
        $currencyList = Currency::select("id","name","symbol","image")->where("status",1)->orderBy("id","ASC")->get();
        $walletArr    = [];
        foreach($currencyList as $key => $c ){
            $trans         = array();
            /*$trans_record  = Transaction::select("id","amount","user_id","type","trans_id","created_at")->where("user_id",$user_id)->whereIn("trans",[0,1,2,3])->where("currency_id",$c['id'])->get();*/
            $withdrawal    = Withdrawal::where("user_id",$user_id)->where("currency_id",$c['id'])->whereIn("status",["Success","Pending"])->get();
            /*foreach($trans_record as $key=> $t){
                array_push($trans, [ "trans_id"=>$t['trans_id'], "amount"=>$t['amount'], "type"=>$t['type'], "created_at"=>$t['created_at'] ] );
            }*/
            foreach($withdrawal as $key=> $t){
                array_push($trans, [ "trans_id"=>$t['trans_id'], "amount"=>$t['amount'], "type"=>"Debit", "created_at"=>$t['created_at'] ] );
            }
            array_multisort(array_map(function($element) {
                return $element['created_at'];
            }, $trans), SORT_DESC, $trans);

            array_push($walletArr, [ "c_name"=>$c['name'],"c_id"=>$c['id'], "c_image"=>$c['image'],"trans"=>$trans ] );
        }
        return view('walletHistory', compact('userData','walletArr'));
    }
}
