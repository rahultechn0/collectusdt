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
                        <h3 class="mb-30 fw600"> Deposit USDT</h3>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                      
                       
                        <div class="col-lg-5 mb-4 mr-auto ml-auto">
                            <div class="card shadow h-100 ">
                                <div class="card-body ">
                                  
                                            
                                               
                                               <div class="text-center mb-4"><img  src="https://chart.googleapis.com/chart?chs=225x225&chld=L%7C2&cht=qr&chl=<?php echo $address?>" alt="QR code" ><br/>
											   <small>Send only USDT to this deposit address</small>
											   
											   </div>
    <div>Wallet Address 
        <br/><b>  
    <input type="text" value="<?php echo $address; ?>" id="referral_link"> 
    <i onclick="copyToClipboard('referral_link','Wallet address Copied','referral_link_msg');" class="fa fa-clone"></i>
</b>
<div class="h6 mb-0 font-weight-bold text-success d-none" id="referral_link_msg"></div>    
</div>
    <div>Network<br/> <b><?php echo $system; ?></b></div>
                                               <div>Amount <br/><b><?php echo $amt; ?> <?php echo $currencyname;?></b></div>
                                                <!--  <a class="btn btn_d" href="<?php echo $url; ?>">
                                                      <i class="fa fa-angle-double-right" aria-hidden="true"></i>  Make Payment
                                                    </a> -->
                                               
                                   
                                </div>
                            </div>
                        </div>  
						
                        </div>

				 </div>
            </div> 






@include('adminCommon.footer')