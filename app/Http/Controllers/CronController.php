<?php
namespace App\Http\Controllers;
use App\Models\Transaction;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use App\Models\Rank;
use App\Models\Currencylist;
use App\Models\Depositamount;
use App\Models\Package;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;

class CronController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $method;


     public function correctLevelCount(){
      ////Parent update data

      $userData    = User::where("packageAmt",">",0)->get();
      if( count($userData) > 0){
        foreach($userData as $key => $final ){
          $directCount    = User::where("parent_id",$final->id)->where("packageAmt",">",0)->count();
          $levelCount     = $directCount;
          if( $levelCount>10){
            $levelCount   = 10;
          }
          User::where("id",$final->id)->update( ["levelCount" =>$levelCount ] );
        }
      }

      //end code
    }

     public function packageamt(){
      ////Parent update data

      $userData    = Transaction::where("type","Package Invest")->where("trans",0)->get();
       print_r(count($userData));
      if(count($userData) > 0){
        foreach($userData as $key => $final ){

          /*$directCount    = User::where("parent_id",$final->user_id)->count();
          $levelCount     = $directCount;
          if( $levelCount>10){
            $levelCount   = 10;
          }*/
          User::where("id",$final->user_id)->update( ["packageAmt" =>$final->amount ] );
        }

      }

      //end code
    }


    public function roiCron(){
        $depositAmount = array(75, 150, 300, 375, 450, 225, 600, 675, 825, 900, 975, 1050);
        $requestData     = Transaction::select("id","amount","user_id","roi_per","roiFix","currency_id","roi_cnt")->whereIn('amount', $depositAmount)->where("type","Package invest")->where("trans",0)->get();

        foreach( $requestData as $key=>$trans){
            $id          = $trans->id;
            $user_id     = $trans->user_id;
            $amount      = $trans->amount;
            $roiPer     = 16.6667;
            $roiCount = $trans->roi_cnt;
            $roiAmt       = ($amount *$roiPer)/100;

            // $userData     = Auth::user();
            // $user_id      = $userData['id'];
            // $totalIncome  = Transaction::where("user_id",$user_id)->whereIn("trans",[1,2,3,5])->sum("amount");
            // $incomeLimit = $totalIncome*3;
            // $roiLimit = $roiAmt*2;

            // if(($totalIncome > $incomeLimit) && ($roiAmt > $roiLimit))
            // {
                if($roiAmt>0 && $roiCount <=12)
                {
                Transaction::create( [ "currency_id"=>1, "user_id"=>$user_id,"trans"=>1,"amount"=>$roiAmt,"from_package"=>$id,"type"=>"ROI"]);
                Transaction::where("id",$id)->increment("roi_cnt",1);
                }
            // }
            // else
            // {
            //     $roiAmt = 0;
            // }
    }
    }

    // public function roiCrons() {
    //     ///Daily Roi
    //     $depositAmount = array(75, 150, 300, 375, 450, 225, 600, 675, 825, 900, 975, 1050);
    //     $requestData     = Transaction::select("id","amount","user_id","roi_per","roiFix","currency_id","roi_cnt")->whereIn('amount', $depositAmount)->where("type","Package invest")->where("trans",0)->get();
    //     // dd($requestData);

    //     foreach( $requestData as $key=>$trans){
    //       $id          = $trans->id;
    //       $user_id     = $trans->user_id;
    //       //$user_id     = 93;
    //       $amount      = $trans->amount;
    //       $roiPer     = 16.6667;
    //       $currency_id = $trans->currency_id;
    //       $roiCount = $trans->roi_cnt;
    //       $roiAmt       = ($amount *$roiPer)/100;

    //       //print_r($roiCount);die("hello");
    //       // $date = date('Y-m-d', strtotime('+1 month'));
    //       // dd($date);
    //       $roiCheck    = Transaction::select("id")->where("trans",1)->where("from_package",$id)->where("user_id",$user_id)->whereDate('created_at', today())->count();
    //     //   dd($roiCheck);
    //       $userData    = User::select("parent_id","parent_str")->where("id",$user_id)->first();
    //       if($roiCheck == 0 ){

    //         $packageAmt   = Transaction::select("amount")->where("user_id",$user_id)->where("trans",0)->sum("amount");
    //         $getIncomeYet = User::userFIXIncome($user_id);
    //         $incomeLimit  = $packageAmt*3;
    //         // dd($incomeLimit);
    //         if($incomeLimit > $getIncomeYet ){
    //           $diff         = $incomeLimit-$getIncomeYet;
    //         //   $roiAmt       = ($amount *$roiPer)/100;

    //         if($roiAmt > $diff ){
    //             $roiAmt     = $diff;
    //           }


    //           if($roiAmt>0){
    //             ////roi given
    //             Transaction::create( [ "currency_id"=>$currency_id, "user_id"=>$user_id,"trans"=>1,"amount"=>$roiAmt,"from_package"=>$id,"type"=>"ROI" ] );

    //             ///Level income
    //             $parent_arr   = array();
    //             $parent_per   = array(0.2,0.1,0.1,0.1,0.1,0.05,0.05,0.05,0.05,0.05);
    //             if($userData['parent_id'])
    //             {

    //               $parent_id    = $userData['parent_id'];
    //               $user         = User::select("parent_str")->where("id",$parent_id)->first();
    //               if($user){
    //                 $parent_str  = $user->parent_str;

    //                 $arr        = array_reverse(explode(",",rtrim($parent_str,",")));
    //                 $arr_cnt    = count($arr);


    //                 if($arr_cnt > 10){
    //                   $arr_cnt  = 10;
    //                 }
    //                 for($i =0;$i<$arr_cnt; $i++){
    //                     array_push($parent_arr, $arr[$i]);
    //                 }
    //               }
    //             }
    //             foreach ($parent_arr as $key => $user) {
    //               if($user>0){
    //                   ///print_r($user);die;
    //                 $userLevel    = User::select("packageAmt","levelCount")->where("id",$user)->first();
    //                 if( ($userLevel['packageAmt']>= 0) && ( $userLevel['levelCount'] >=($key+1))){
    //                   $packageAmt_1    = Transaction::select("amount")->where("user_id",$user)->where("trans",0)->sum("amount");

    //                   $levelAmt        = $roiAmt*$parent_per[$key];
    //                   if($packageAmt_1>0){

    //                     $getIncomeYet_1 = User::userFIXIncome($user);
    //                     $incomeLimit_1  = $packageAmt_1*2.6;
    //                     $diff_1         = $incomeLimit_1 - $getIncomeYet_1;
    //                     if($levelAmt>$diff_1){
    //                       $levelAmt     = $diff_1;
    //                     }
    //                     /*if($levelAmt>0){
    //                       Transaction::create( [
    //                         "user_id"=>$user,"currency_id"=>$currency_id,
    //                         "refrall_id"=>$user_id,
    //                         "trans"=>2,
    //                         "amount"=>$levelAmt,
    //                         "from_package"=>$id,
    //                         "type"=>"Level-".($key+1)
    //                       ]);
    //                     }*/
    //                   }

    //               }
    //              }
    //             }
    //             ///Update package invest transaction
    //             Transaction::where("id",$id)->increment("roi_cnt",1);
    //           }

    //         }else{
    //           Transaction::where("id",$id)->update([ 'roi_cnt' => 0 ]);
    //         //   Transaction::where("id",$id)->update( ["trans"=>8 ] );
    //         }
    //       }
    //     }

    //     $completeTrans  = Transaction::where("trans",0)->where( 'roi_cnt', DB::raw('`roi_max`') )->get();

    //     foreach($completeTrans as $key => $trans ){
    //       Transaction::where("from_package",$trans['id'])->where("trans",4)->update( [ "trans"=>1 ] );

    //       //Transaction::where("id",$trans['id'])->update( [ "trans"=>8 ] );
    //     }
    // }
    function fastBonusCron(){

        $userList         = User::select("id")->whereDate('created_at','>=',Carbon::now()->subdays(7))->get();
        foreach($userList as $key => $user ){
            $user_id      = $user['id'];
            $lastAmount   = Transaction::where("trans",0)->where("user_id",$user_id)->orderBy("id","ASC")->first();
            $teamUser     = User::select("id")->where("parent_id",$user_id)->first();
            if(isset($teamUser['id']) && $teamUser['id']!= ""){

            $directCount  = Transaction::where("amount",">=",$lastAmount['amount'])->where("trans",0)->where("user_id",$teamUser['id'])->orderBy("id","ASC")->count();
            $fastCheck    = Transaction::where("trans",4)->where("user_id",$user_id)->count();
            if($fastCheck==0 && $directCount >= 0){
              Transaction::where("id",$lastAmount['id'])->update( ["roiFix"=>3] );
            }
          }
        }
    }
    function rewardCron(){
      $userList         = User::select("id","parent_str")->where("id",">",1)->get();
      foreach($userList as $key => $user ){
          $user_id      = $user['id'];
          $directCount  = User::where("parent_id",$user_id)->count();
          if($directCount >= 0){
              $parent_str   = $user['parent_str'];
              $teamUser     = User::select("id")->where("id","!=",$user_id)->where("parent_str","LIKE",$parent_str."%")->get();
              if( count($teamUser) > 0 ){
                $totalBusiness = Transaction::select("amount")->whereIn("user_id",$teamUser)->where("trans",0)->sum("amount");
                ///echo "UserId::".$user_id." Team Size::".count($teamUser)." totalBusiness::".$totalBusiness;
                $rewardData          =  Rank::where("minBusiness","<=",$totalBusiness)->where("maxBusiness",">=",$totalBusiness)->first();
                ///echo " rewardId:: ".$rewardData['id'];
                if($rewardData){
                    $firstLegBusiness = $rewardData['amount']*0.4;
                    $condtionCheck    = Transaction::select("id")->whereIn("user_id",$teamUser)->where("trans",0)->where("amount",">",$firstLegBusiness)->count();
                    ///echo " firstLegBusiness::".$firstLegBusiness." condtionCheck:: ".$condtionCheck;
                    $rewardCheck      = Transaction::select("id")->where("packageId",$rewardData['id'])->where("trans",5)->where("user_id",$user_id)->count();
                    ///echo " RewardCheck::".$rewardCheck;
                    if($rewardCheck == 0 && $condtionCheck>0 ){
                      Transaction::create( ["packageId"=>$rewardData['id'],"currency_id"=>1, "roi_cnt"=>1, "user_id"=>$user_id,"trans"=>5,"roi_max"=>12, "amount"=>$rewardData['reward'],"type"=>"Reward Bonus" ] );
                    }
                }
              }
            //echo "</br>";
          }
      }
      ///Update last reward count
      $requestData     = Transaction::select("id","created_at")->whereColumn("roi_max",">","roi_cnt")->where("type","Reward Bonus")->where("trans",5)->get();
      foreach( $requestData as $key=>$trans){
        $today         = date("Y-m-d");
        $creadet_at    = date("Y-m-d",strtotime($trans['created_at']));

        $to            = \Carbon\Carbon::createFromFormat('Y-m-d', $today);
        $from          = \Carbon\Carbon::createFromFormat('Y-m-d', $creadet_at);
        $diff_in_days  = $to->diffInDays($from);
        if($diff_in_days>0){
          $count         = (int)($diff_in_days/7);
          if($count>12){
            $count       = 12;
          }
          ///echo " Reward created:: ".$creadet_at." today ::".$today. " diff_in_days:: ".$diff_in_days." rewardCount ".$count;
          ///echo "</br>";
          Transaction::where("id",$trans['id'])->update([ "roi_cnt"=>$count ]);
        }
      }

    }
    function priceCron(){
      $cArr    = array("BNBUSDT","BUSDUSDT","TRXUSDT","BTCUSDT","DOGEUSDT","LTCUSDT");
      foreach($cArr as $key => $c ){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://www.binance.com/api/v3/ticker/24hr?symbol='.$c,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Cookie: __ddg1_=xKmx740mhJ831Dl2eIl0; lng=en'
            ),
        ));
        $response = curl_exec($curl);

        curl_close($curl);
        $res        = json_decode($response,true);
        $lastPrice  = $res['lastPrice'];
        $sellPrice  = (float) ( $lastPrice - 0.00999 );
        $qty        = $res['lastQty'];
        Currencylist::create( [ "symbol"=>$c, "buyPrice"=>$lastPrice,"sellPrice"=>$sellPrice,"volume"=>$qty ] );

      }
    }
}
