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
        <h3 class="mb-30 fw600 mb-3">Rank Income</h3>
    </div>

        <div class="card shadow cardtable">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S No</th>
                                <th>Rank Name</th>
                                <th>Team Business</th>
                                <th>Weekly Bonus</th>
                                <th>Get Bonus</th>
                                <th>Status</th>
                                <th>More Details</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($ranks as $key=> $rank )
                            @php 
                                $total       = 0;
                                $getBonus    = \App\Models\Transaction::select("amount","roi_cnt")->where("packageId",$rank['id'])->where("trans",5)->first();
                                if($getBonus){
                                    $total   = $getBonus['amount']*$getBonus['roi_cnt'];
                                }
                                $status      = "Pending";
                                if($total>0){
                                    $status  = "Ongoing";

                                    if( $total >= $getBonus['amount']*12 ){
                                        $status  = "Complete";
                                    }
                                }

                            @endphp
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td><b>{{ $rank->name }}</b></td>  
                                <td><b>${{ number_format( $rank['amount'],2 ) }}</b></td>  
                                <td><b>${{ number_format( $rank['reward'],2 ) }}</b></td>  
                                <td><b>${{ number_format( $total,2 ) }}</b></td>  
                                <td><b>@php echo $status; @endphp</b></td>
                                <td><a href="javascript:void(0)">Click Here</a></td>  
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
        <div class="heading ">
        <h3 class="mb-30 fw600 mt-3">Rank Details</h3>
    </div>
        <div class="card shadow cardtable">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>S No</th>
                        <th>Rank Name</th>
                        <th>Bonus</th>
                        <th>Datetime</th>
                    </tr>
                </thead>

                <tbody>
                    
                </tbody>
            </table>
        </div>
        </div>
</div>
@section('footerScript')

@endsection
@include('adminCommon.footer')