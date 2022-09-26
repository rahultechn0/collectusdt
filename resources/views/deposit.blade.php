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

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="heading">
                        <h3 class="mb-30 text-gray-800 font-weight-bold">Deposit Manager</h3>
                    </div>

         
                </div>
            </div>
            <!-- End of Main Content -->

            @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif





    <div class="profile-form pt-20">
        {!! Form::open(["url"=>"saveDeposit","method"=>"POST","autocomplete"=>"off"]) !!}
        
             
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="form-outline mb-3">
                        <label for="sdf">RegisterId</label>
                        <select name="user_id" id="user_id" class="form-control" required="required"> 
                            <option value="">Select User</option>
                            @foreach( $userlist as $key => $user )
                                <option value="@php echo $user['id']; @endphp">@php echo $user['fname'];@endphp @php echo $user['lname'];@endphp /@php echo $user['registerId'];@endphp</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="form-outline mb-3">
                        <label for="sdf">Currency</label>
                        <select name="currency_id" id="currency_id" class="form-control" required="required"> 
                            <option value="">Select Currency</option>
                            @foreach( $currencylist as $key => $c )
                                <option value="@php echo $c['id']; @endphp">@php echo $c['name'];@endphp</option>
                            @endforeach
                        </select>
                    </div>
                </div> 
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="form-outline mb-3">
                        <label for="sdf">Amount</label>
                        <input type="number" name="amount" class="form-control" value="" required="required">                        
                    </div>
                </div>
            </div> 
 
            <div class="row">    
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="text-right text-lg-start ">
                    <button type="submit" class="btn btn-lg">Save</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!} 

    </div>


    <div class="container-fluid">
    <div class="heading ">
        <h3 class="mt-30 mb-30 text-gray-800 font-weight-bold">Last 10 Deposit</h3>
    </div>

        <div class="card shadow cardtable">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S No</th>
                                <th>Register Id</th>
                                <th>Token</th>
                                <th>Amount</th>
                                <th>Deposit Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                                @foreach($lastDeposit as $key=>$list)
                                <tr>
                                    <td>@php echo $key+1; @endphp</td>
                                    <td>@php echo $list->userData->registerId; @endphp</td>
                                    <td>@php echo $list->currencyData->name; @endphp</td>
                                    <td>@php echo $list['amount']; @endphp</td>
                                    <td>@php echo $list['created_at']; @endphp</td>
                                    <td>@php echo $list['status']; @endphp</td>
                                    <td>
                                        @if($list['status'] =="Success")
                                            <a onclick="return confirm('Are you sure ?')" href="{{url('failedDeposit/'.$list['id']) }}">Cancel Deposit</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
</div>


<style>
    .profile-form{width: 93% !important;}
</style>

        @include('adminCommon.footer')