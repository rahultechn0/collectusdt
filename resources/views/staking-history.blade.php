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
            @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif
                <!-- End of Topbar -->
                <div class="container-fluid">
                    <div class="heading ">
                        <h3 class="text-gray-800 mb-30 font-weight-bold">Staking History</h3>
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
                                <th>S No</th>
                                <th>Name</th>
                                <th>Token</th>
                                <th>APY %</th>
                                <th>Amount</th>
                                <th>Locking Period</th>
                                <th>Balance</th>                                
                                <th>Unstake</th>
                            </tr>
                        </thead>

                        <tbody> 
                          @if( count($stakesData) > 0)
                            @foreach( $stakesData as $key=> $stake )
                              @php
                                  $date1   = date("Y-m-d",strtotime($stake['created_at'])); 
                                  $today   = date("Y-m-d"); 
                                  $diff    = abs(strtotime($today) - strtotime($date1)); 
                                  $years   = floor($diff / (365*60*60*24)); 
                                  $months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
                                  $days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                  $amount  = $stake['amount']*($stake['apy']/36000)*$days;
                                  $show    = 0;
                                  if($today > date("Y-m-d",strtotime($stake['completeDate'])) ){
                                    $show  = 1;
                                  }
                              @endphp
                                <tr>
                                    <td>@php echo $key+1; @endphp</td>
                                    <td>@php echo $stake->currencyData->name; @endphp</td>
                                    <td><img src="{{ asset('bitsair/img/'.$stake->currencyData->image) }}" alt=""></td>
                                    <td>@php echo $stake['apy']; @endphp</td>
                                    <td>@php echo $stake['amount']; @endphp</td>
                                    <td>@php echo $stake['lockingPeriod']; @endphp</td>
                                    <td>@php echo number_format($amount,6); @endphp</td>
                                    @if($show==0)
                                      <td><a disabled="disabled" >Unstake Now</a></td>
                                    @elseif($show==1 && $stake['status']=="Pending")
                                      <td><a onclick="return confirm('Are you sure want to unstak this ?')" href="{{ url('unStake/'.$stake['id']) }}" >Unstake Now</a></td>
                                    @else
                                      <td><a >Unstaked</a></td>
                                    @endif

                                </tr>
                              @endforeach
                          @else
                              <tr>
                                <td colspan="8" class="text-danger text-center">No records found</td>
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

@include('adminCommon.footer')