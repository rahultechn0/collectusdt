@include('adminCommon.header')
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
    @include('adminCommon.sidebar')
    <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
            @include('adminCommon.topbar')
                

 
            </div>
           

  <div class="container-fluid">
    <div class="heading ">
        <h3 class="mb-30 fw600 mb-3">Wallet</h3>
    </div>

        <div class="card shadow cardtable">
                <div class="table-responsive">
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S. No.</th>
                                <th>Currncy</th> 
                                <th>Available Balance</th>
                                <th>Withdrawal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($walletArr as $key=>$wallet )
                            <tr>
                                <td>@php echo $key+1; @endphp</td>
                                <td><img src="{{asset('html/img/'.$wallet['c_image'])}}">{{ $wallet['c_name'] }}</td>
                                <td>@php echo number_format( ( $wallet['roi']+$wallet['level']+$wallet['referral']-$wallet['Withdrawal']-$wallet['fees']),6);@endphp USDT</td>

                                <td><button class="btn btn-info" onclick="myFunction(<?php echo $wallet['c_id'];?>)" >Withdrawal</button></td>
                            </tr>
                            <div class="modal fade" id="withdrawal_popopDiv">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Withdrawal Request</h5>
                      <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <div class="modal-body p-4">
                      <div class="row">
                          <div class="col-md-12 grxDiv">
                          <label>Wallet Address</label>
                          <input type="text" class="form-control mb-3" name="address" id="address" readonly>
                        </div>
                        <div class="col-md-12 grxDiv">
                          <label>Withdrawal Fees</label>
                          <input type="text" class="form-control mb-3" name="fees" id="fees" readonly>
                        </div>
                          <div class="col-md-12 grxDiv">
                          <label>Available Amount</label>
                          <input type="text" class="form-control mb-3" name="tot_amt" id="tot_amt" readonly>
                          <input type="hidden" class="form-control mb-3" name="c_id" id="c_id" readonly>
                        </div>
                       <div class="col-md-12 grxDiv">
                          <label>Withdrawal Amount</label>
                          <input type="number" class="form-control mb-3" name="amt" id="amt" placeholder="Enter amount for withdrawal">
                          <p>**Minimum Withdrawal 10 USDT</p>
                        </div>
                   </div>
              <div class="text-center register-btn-outer">
         
             <button class="btn btn-info" onclick="myFunction2()" >Withdrawal</button>
          </div>
        </div>
      </div>
    </div>
  </div>
                            @endforeach


                        </tbody>
                    </table> </div>
                </div>
                
</div>
@section('footerScript')
<script type="text/javascript">
 
  function myFunction(c_id) {
   var currencyId = c_id;
  
    //if (confirm('Are you sure you want to invest with : '+investAmt)) {
            $.ajax({ 
                url: "/withdrawal",
                data:{ 
                    "currencyId":currencyId
                },
                type: 'POST',
                dataType: 'json',async: false,
                success: function(res)
                { 
                    if(res.type=="success"){
                       $('#withdrawal_popopDiv').modal('show');
                        $('#address').val(res.wallet_address);
                        $('#tot_amt').val(res.balance);
                        $('#c_id').val(res.c_id);
                        $('#fees').val(res.c_fees);
                    }else{
                        $.toaster({ priority : 'danger', title : 'Withdrawal Alert !', message : res.msg});
                    }
                    
                }
            });
        //}
  


     }
</script>

<script type="text/javascript">
 
  function myFunction2() {
  var c_id = $('#c_id').val();
  var amt = $('#amt').val();
  
  if(amt<10){
      $.toaster({ priority : 'danger', title : 'Withdrawal Alert !', message :"Minimum 10 USDT for request..." }); 
      return false;
  }
  var wallet_address = $('#address').val(); 
   //if (confirm('Are you sure you want to invest with : '+investAmt)) {
            $.ajax({ 
                url: "/withdrawalrequest",
                data:{ 
                    "c_id":c_id,"amt":amt,"wallet_address":wallet_address
                },
                type: 'POST',
                dataType: 'json',async: false,
                success: function(res)
                { 
                    if(res.type=="success"){
                       $.toaster({ priority : 'success', title : 'Withdrawal Alert !', message : res.msg});
                        setTimeout(function () {

                                window.location.href = "/wallet";
                        }, 5000)
                    }else{
                      $.toaster({ priority : 'danger', title : 'Withdrawal Alert !', message : res.msg});
                    }
                    
                }
            });
        //}
  


     }
</script>
<script type="text/javascript">
$('.form-check-input').click(function() {
  if ($(this).is(':checked')) {
    $('.accept-terms-btn').removeAttr('disabled');
  } else {
    $('.accept-terms-btn').attr('disabled', 'disabled');
  }
});

</script>

@endsection
@include('adminCommon.footer')