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
        <h3 class="mb-30 fw600 mb-3">Withdrawal Request</h3>
    </div>

        <div class="card shadow cardtable">
                <div class="table-responsive">
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S. No.</th>
                                <th>Username</th>
                                <th>Currncy</th>                                
                                <th>wallet Address</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($withdrawalList as $key=>$wallet )
                            <tr>
                                <td>@php echo $key+1; @endphp</td>
                                <td>@php echo $wallet->user->username; @endphp</td>
                                <td>@php echo $wallet->currency->name; @endphp</td>
                                <td>@php echo $wallet['wallet_address']; @endphp</td>
                                <td>@php echo $wallet['amount']; @endphp</td>
                                <td>@php echo $wallet['status']; @endphp</td>
                                <td>@php echo $wallet['created_at']; @endphp</td>
                                <td><?php if($wallet['status']=='Pending'){?><button class="btn btn-info withdraw"  onclick="myFunction(<?php echo $wallet['id'];?>)" >Approve</button>
                                <?php } ?>
                                </td>
                            </tr>
                            @endforeach
                          </div>


                        </tbody>
                    </table> </div>
                </div>
                
</div>
@section('footerScript')
<script type="text/javascript">
 
  function myFunction(id) {
    $('.withdraw').attr("disabled","disabled")
     var Id = id;
    //alert(Id)
    //if (confirm('Are you sure you want to invest with : '+investAmt)) {
            $.ajax({ 
                url: "/public/withdrawalapprove",
                data:{ 
                    "Id":Id
                },
                type: 'POST',
                dataType: 'json',async: false,
                success: function(res)
                { 
                    if(res.type=="success"){
                       //$('#withdrawal_popopDiv').modal('show');
                        $.toaster({ priority : 'success', title : 'Withdrawal Alert !', message : res.msg});
                        
                        /*setTimeout(function () {
                                window.location.href = webLink+"package-history";
                        }, 5000);*/
                    }else{
                        $.toaster({ priority : 'danger', title : 'Withdrawal Alert !', message : res.msg});
                        $('.withdraw').removeAttr("disabled","disabled");
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
  var wallet_address = $('#address').val();

  alert(c_id);
   //if (confirm('Are you sure you want to invest with : '+investAmt)) {
            $.ajax({ 
                url: "/public/withdrawalrequest",
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
                                window.location.href = "https://www.collectusdt.com/wallet";
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