@include('adminCommon.header')
<style type="text/css">
    .error{ color:red; font-size: 14px;}
</style>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
    @include('adminCommon.sidebar')
    <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
        @include('adminCommon.topbar')
            <!-- Main Content -->
            <div id="content">
                
           <!-- Begin Page Content -->
                <div class="container-fluid mb-50">

                
            @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif
                    <!-- Page Heading -->
                    <div class="heading ">
                        <h3 class="mb-30 fw600">Dashboard</h3>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-lg-8 mb-4">
                            <div class="card border-left-success shadow h-100 ">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-end">
                                        <div class="col-12">

                                            {!! Form::open(["url"=>"saveaddress","autocomplete"=>"off","method"=>"POST"]) !!}                                   
                                            <div class="row deposit_d">

                                                <div class="col-12 col-md-7 mb-2">  
                                                    <div class=" fw500 mb-1">Deposit</div>	  
                                                    <input type="text" placeholder="Enter Amount" id="mainamount" name="amt" class="form-control ">
                                                    <div id="error" class="error"></div>
                                                </div>
                                                <div class="col-12 col-md-5 mb-2">  
                                                    <div class=" fw500 mb-1">Choose Network</div> 
                                                    <div class="select_d">                                     
                                                        <select class="form-control" name="currency"onchange="setamount();">
                                                        @foreach($currencyList as $key => $c )
                                                            <option value="@php echo $c['id']; @endphp">@php echo $c['name']; @endphp</option>
                                                        @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <!-- <a class="btn btn_d" href="#">
                                                    <i class="fa fa-angle-double-right" aria-hidden="true"></i>  Stake USDT
                                                    </a> -->
                                                    {!! Form::input("submit","Save","Stake USDT", ["class"=>"btn  btn_d"]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>  
						<div class="col-lg-4 mb-4">
                            <div class="card border-left-success shadow h-100 ">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class=" fw500 mb-1">
                                                Available Wallet Balance</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">@php echo number_format($totalIncome,2); @endphp <small>USDT</small></div>
                                        </div>
                                        <div class="col-auto">
										<span class="d_icon" >
                                          <img src="{{asset('html/img/usdt.png')}}" alt="Logo" >
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4 class="mb-30 fw600 mb-3">Active Package</h4>
                   
                        <!-- Pending Requests Card Example -->
                       <div class="row ">

                        <?php if(count($activePackages)>0){?>
                                @foreach($activePackages as $key =>$active )
                                    @php 
                                        $roiAmt  = \App\Models\Transaction::where("from_package",$active['id'])->where("trans",1)->sum("amount");
                                    @endphp
                                    <div class="col-lg-4 mb-4">
                                        <div class="card border-left-success shadow h-100 ">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class=" fw600 mb-1 h5">
                                                        @php echo number_format($active['amount'],2); @endphp @php echo $active->currencyData->name; @endphp</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">@php echo number_format($roiAmt,2); @endphp <small>USDT Dividend </small></div>
                                                    </div>
                                                    <div class="col-auto">
                                                    <span class="d_icon" >
                                                    <img src="{{asset('html/img/'.$active->currencyData->image )}}" alt="Logo" >
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            <?php } else { ?>
                                    <div class="col-lg-12 mb-4 text-center">
                                        <p>There is no package activate yet.</p>
                                    </div>
                           <?php } ?>
                       </div>
                        <div class="row">
                             <div class="col-lg-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class=" fw500 mb-1">Referral Link</div>
                                                <input class="width-100" id="referral_link" value="{{ url('register/'.$userData['username'])}}" /> <i class="fa fa-copy" onClick="copyToClipboard('referral_link','Referral link Copied','referral_link_msg');" aria-hidden="true"></i>
                                                <div class="h6 mb-0 font-weight-bold text-success d-none" id="referral_link_msg"></div>
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                            <div class="col-lg-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class=" fw500 mb-1">Referral Code</div>
                                                <input class="width-100" id="referral_code" value="@php echo $userData['username'];@endphp" /> <i class="fa fa-copy" onClick="copyToClipboard('referral_code','Referral code Copied','referral_code_msg');" aria-hidden="true"></i>
                                                <div class="h6 mb-0 font-weight-bold text-success d-none" id="referral_code_msg"></div>
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>

 
                 <h4 class="mb-30 fw600 mb-3">Income</h4>
				 <div class="row mb-5">
				 <div class="col-lg-4 mb-4">
                            <div class="card border-left-success shadow h-100 ">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class=" fw500 mb-1">
                                                Referral Income</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">@php echo number_format($referralIncome,2); @endphp <small>USDT</small></div>
                                        </div>
                                        <div class="col-auto">
										<span class="d_icon" >
                                          <i class="fa fa-users" aria-hidden="true"></i>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
				 <div class="col-lg-4 mb-4">
                            <div class="card border-left-success shadow h-100 ">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class=" fw500 mb-1">
                                                Level Income</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">@php echo number_format($levelIncome,2); @endphp <small>USDT</small></div>
                                        </div>
                                        <div class="col-auto">
										<span class="d_icon" >
                                          <i class="fa fa-level-up" aria-hidden="true"></i>

                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
				 <div class="col-lg-4 mb-4">
                            <div class="card border-left-success shadow h-100 ">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class=" fw500 mb-1">
                                                Rank Bonus</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">@php echo number_format($rankIncome,2); @endphp <small>USDT</small></div>
                                        </div>
                                        <div class="col-auto">
										<span class="d_icon" >
                                         <i class="fa fa-star" aria-hidden="true"></i>

                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
				 </div>
            </div>
            <?php if(!empty($expirePackages)){?>
            <?php if($expirePackages['trans'] == 8){ ?>

<div class="modal fade show" tabindex="-1" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
       Package Expired
        <button type="button" class="btn-close" style="width: 15px; margin-left: auto; color: #fff;  float: right;    background-color: #fff;" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-md-5 text-center">
      <h5>Your Package is expired.<br/>Please reactivate your package to earn level income.</h5>
      </div>
 
    </div>
  </div>
</div>
<?php } ?>
<?php } ?>
<script type="text/javascript">
    ///document.getElementById("coinpayment_button").disabled = true;
function setamount(){
    var amount = document.getElementById('mainamount').value;
    var minmumamt =<?php echo $packageData['minDeposit']?>;

    if(amount>=minmumamt){
    var currency = document.getElementById('currency').value;
             document.getElementById("coinpaymentamount").value = amount;
               document.getElementById("currency_name").value = currency;
                 // document.getElementById("coinpaymentamount1").value = amount;
                  ///document.getElementById("coinpayment_button").disabled = false;
                  document.getElementById('error').innerHTML ="";
            
       
        //document.getElementById('paypalamount').value=amount;
        //document.getElementById('coinpaymentamount').value=amount;
        //document.getElementById("paypal_button").disabled = false;
        
  
    }else{
        document.getElementById('error').innerHTML ="Please fill more than "+minmumamt+" amount.";
    }
    //alert(amount);
}

function setcurrency(){
  var currency = document.getElementById('currency').value;
           
               ///document.getElementById("coinpayment_button").disabled = false;
          
        
  
    
    //alert(amount);
}
</script>






@include('adminCommon.footer')