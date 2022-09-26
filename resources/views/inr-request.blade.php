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
            <!-- End of Main Content -->

  <div class="container-fluid">
    <div class="heading ">
        <h3 class="mb-30 text-gray-800 font-weight-bold">INR Deposit Request</h3>
    </div>

        <div class="card shadow cardtable">
            @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S No</th>
                                <th>RegisterId</th>
                                <th>Utr No</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Photo</th>
                                <th>Request Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($requestData as $key=> $req )
                            <tr>
                                <td>@php echo $key+1; @endphp</td>
                                <td>@php echo $req->userData->registerId; @endphp</td>
                                <td>@php echo $req['utr_no']; @endphp</td>
                                <td>@php echo $req['amount']; @endphp</td>
                                <td>@php echo $req['date']; @endphp</td>
                                <td><a href="{{asset('bitsair/images/'.$req['photo'])}}" target="_blank"><img src="{{asset('bitsair/images/'.$req['photo'])}}" height="100" width="100" alt=""></a></td> 
                                <td>@php echo $req['created_at']; @endphp</td> 
                                <td>@php echo $req['status']; @endphp</td> 
                                <td>
                                    <a onclick="return confirm('Are you sure approved this request ?')" href="{{ url('actionINRrequest') }}/1/@php echo $req['id']; @endphp">Success</a> | 
                                    <a onclick="return confirm('Are you sure reject this request ?')" href="{{ url('actionINRrequest') }}/0/@php echo $req['id']; @endphp">Failed</a>
                                </td> 
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
</div>
@section('footerScript')
<script type="text/javascript">
    $(".buySubscription").click(function(){
        var subsId   = $(this).attr("data-subsId");
        var amount   = $(this).attr("data-amount");
        if (confirm('Are you sure you want to Subscription now with : '+amount)) {
            $.ajax({ 
                url: "/subscriptionRequest",
                data:{ 
                    "subsId":subsId
                },
                type: 'POST',
                dataType: 'json',async: false,
                success: function(res)
                { 
                    if(res.status==1){
                        $.toaster({ priority : 'success', title : 'Subscription Alert !', message : res.msg});
                        setTimeout(function () {
                                    window.location.href = webLink+"package-history";
                        }, 5000);
                    }else{
                        $.toaster({ priority : 'danger', title : 'Subscription Alert !', message : res.msg});
                    }
                    
                }
            });
        }
    }); 
</script>

@endsection
@include('adminCommon.footer')