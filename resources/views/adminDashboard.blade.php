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

 
                    <!-- Page Heading -->
                    <div class="heading ">
                        <h3 class="mb-30 fw600">Dashboard</h3>
                    </div>

                    <!-- Content Row -->
          

                   
                        <!-- Pending Requests Card Example -->
                       <div class="row">

                            <div class="col-lg-3 mb-3">
                                <div class="card border-left-success shadow h-100 ">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class=" fw500 mb-1">Activate User</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">@php echo $adminArr['userCount']; @endphp</div>
                                            </div>
                                            <div class="col-auto">
                                                <span class="d_icon" ><i class="fa fa-users" aria-hidden="true"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <div class="card border-left-success shadow h-100 ">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class=" fw500 mb-1">Activate Package</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">@php echo $adminArr['packageCnt']; @endphp</div>
                                            </div>
                                            <div class="col-auto">
                                                <span class="d_icon" ><i class="fa fa-bars" aria-hidden="true"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <div class="card border-left-success shadow h-100 ">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class=" fw500 mb-1">Total Deposit</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">@php echo number_format($adminArr['packageAmt'],2); @endphp</div>
                                            </div>
                                            <div class="col-auto">
                                                <span class="d_icon" ><i class="fa fa-usd" aria-hidden="true"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <div class="card border-left-success shadow h-100 ">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class=" fw500 mb-1">Total Withdrawal</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">@php echo number_format($adminArr['withAmt'],2); @endphp</div>
                                            </div>
                                            <div class="col-auto">
                                                <span class="d_icon" ><i class="fa fa-usd" aria-hidden="true"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 


                </div>
            </div>
        </div>  
@include('adminCommon.footer')