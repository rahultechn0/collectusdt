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

                <!-- End of Topbar -->
     
                <div class="container-fluid mb-50">

                    <!-- Page Heading -->
                    <div class="heading ">
                        <h3 class="mb-30 text-gray-800 font-weight-bold">Referral</h3>
                    </div>

                    <!-- Content Row -->
                    <div class="row"> 

                        <div class="col-lg-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Referral Link</div>
                                            <input class="width-100" id="referral_link" value="http://bitsair.co/register/@php echo $userData['registerId'];@endphp" /> <i class="fa fa-copy" onClick="copyToClipboard('referral_link','Referral link Copied','referral_link_msg');" aria-hidden="true"></i>
                                            <div class="h6 mb-0 font-weight-bold text-success d-none" id="referral_link_msg"></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-users" aria-hidden="true"></i>
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
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Referral Code</div>
                                            <input class="width-100" id="referral_code" value="@php echo $userData['registerId'];@endphp" /> <i class="fa fa-copy" onClick="copyToClipboard('referral_code','Referral code Copied','referral_code_msg');" aria-hidden="true"></i>
                                            <div class="h6 mb-0 font-weight-bold text-success d-none" id="referral_code_msg"></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-users" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <!-- End of Main Content -->


    

    <div class="container-fluid pb-70">
        <div class="row align-items-center">
        <div class="col-lg-12">
        <div class="card shadow">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>RegisterId</th> 
                                <th>Name</th> 
                                <th>Email</th> 
                                <th>Registeration Date</th> 
                            </tr>
                        </thead>

                        <tbody>
                            @if( count($teamData)>0 )
                                @foreach( $teamData as $key=> $user )
                                <tr>
                                    <td>@php echo $key+1; @endphp</td>
                                    <td>@php echo $user['registerId']; @endphp</td>
                                    <td>@php echo $user['fname']." ".$user['lname']; @endphp</td>
                                    <td>@php echo $user['email']; @endphp</td>
                                    <td>@php echo $user['created_at']; @endphp</td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center text-danger">No data found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                </div>
            </div>






    </div>
    </div>





<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
    <div class="row ">

    <div class="col-lg-12 mb-20">
    <input type="text" id="form3Example3" class="form-control " placeholder="Balance: 10000 BNB" />
    </div>

    <div class="col-lg-12 mb-20">
    <input type="text" id="form3Example3" class="form-control " placeholder="Enter Amount For Stake" />
    </div>



    <div class="col-lg-12 ">
    <div class="st-brtn ">
    <button type="button" class="btn btn-lg">Unstake</button>
    </div>
    </div>


    </div>
      </div>



    </div>
  </div>
</div>
@section('footerScript')

@endsection
@include('adminCommon.footer')