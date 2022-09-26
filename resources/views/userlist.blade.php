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
        <h3 class="mb-30 fw600 mb-3">User Management</h3>
    </div>

        <div class="card shadow cardtable">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S No</th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Active Package</th>
                                <th>Deposit</th>
                                <th>Income</th>
                                <th>Withdrawal</th>
                                <th>Team Size</th>
                                <th>Created At</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($userlist as $key=> $user )
                            

                            @php
                                $activatePackage  = \App\Models\Transaction::select("id")->where("user_id",$user['id'])->where("trans",0)->count();
                                $depositAmt       = \App\Models\Transaction::select("id")->where("user_id",$user['id'])->where("trans",0)->sum("amount");
                                $incomeAmt        = \App\Models\Transaction::select("id")->where("user_id",$user['id'])->whereIn("trans",[1,2,3,5])->sum("amount");
                                $withdAmt         = \App\Models\Withdrawal::select("id")->where("user_id",$user['id'])->whereIn("status",["Success","Pending"])->sum("amount");
                                $teamSize         = \App\Models\User::select("id")->where("parent_str","LIKE",$user['parent_str']."%")->count();

                            @endphp
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>@php echo $user['username']; @endphp</td>
                                <td>@php echo $user->parent->username; @endphp</td>
                                <td>@php echo $activatePackage; @endphp</td>
                                <td>@php echo number_format($depositAmt,2); @endphp</td>
                                <td>@php echo number_format($incomeAmt,2); @endphp</td>
                                <td>@php echo number_format($withdAmt,2); @endphp</td>
                                <td>@php echo $teamSize; @endphp</td>
                                <td>@php echo $user['created_at']; @endphp</td>
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