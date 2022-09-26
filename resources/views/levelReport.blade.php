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
        <h3 class="mb-30 fw600 mb-3">Level Report</h3>
    </div>

        <div class="card shadow cardtable">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S No</th>
                                <th>Username</th>
                                <th>Level Type</th>
                                <th>Income</th>
                                <th>Datetime</th>
                                <th>Network Type</th>                                
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($levelTrans as $key=> $level )
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td><b>{{ $level->userData->username }}</b></td>  
                                <td><b>{{ $level['type'] }}</b></td>  
                                <td><b>{{ $level['amount'] }}</b></td>  
                                <td><b>{{ $level['created_at'] }}</b></td>  
                                <td><b>{{ $level->currencyData->name }}</b></td>
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