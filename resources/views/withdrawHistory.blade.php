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
        <h3 class="mb-30 fw600 mb-3">Withdrawal History</h3>
    </div>

        <div class="card shadow cardtable">
                <div class="table-responsive">
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S. No.</th>
                                <th>Username</th>
                                <th>Amount</th>                                
                                <th>Datetime</th>
                                <th>Wallet Address</th>
                                <th>Network Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($withdrawalList as $key=>$wallet )
                            <tr>
                                <td>@php echo $key+1; @endphp</td>
                                <td>@php echo $wallet->user->username; @endphp</td>
                                <td>@php echo $wallet['amount']; @endphp</td>
                                <td>@php echo $wallet['created_at']; @endphp</td>
                                <td>@php echo $wallet['wallet_address']; @endphp</td>
                                <td>@php echo $wallet->currency->name; @endphp</td>
                            </tr> 
                            @endforeach
                        </tbody>
                </table>
            </div>
                </div>
                
</div>
@section('footerScript') 

@endsection
@include('adminCommon.footer')