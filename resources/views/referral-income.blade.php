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
                        <h3 class="mb-30 text-gray-800 font-weight-bold">Referral Income</h3>
                    </div>

                    <!-- Content Row -->
                    <div class="row"> 
                        <div class="col-lg-12">
                            <div class="card shadow">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Sr No</th>
                                                <th>RegisterId</th>
                                                <th>Package Name</th>
                                                <th>Level Income</th>
                                                <th>Level Type</th>                                                
                                                <th>Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($levelIncome)>0)
                                            @foreach( $levelIncome as $key => $income )
                                            <tr>
                                                <td>@php echo $key+1; @endphp</td>
                                                <td>@php echo $income->referralData->registerId; @endphp</td>
                                                <td>@php echo $income->subscriptionData->name; @endphp</td>
                                                <td>@php echo $income->amount; @endphp</td>
                                                <td>@php echo $income->type; @endphp</td>
                                                <td>@php echo $income->created_at; @endphp</td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td colspan="6" class="text-center text-danger">No data found</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Main Content --> 
@include('adminCommon.footer')