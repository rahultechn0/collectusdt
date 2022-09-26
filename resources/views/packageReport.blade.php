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
        <h3 class="mb-30 fw600 mb-3">Package Report</h3>
    </div>

        <div class="card shadow cardtable">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S No</th>
                                <th>Username</th>
                                <th>Network</th>
                                <th>Package Amount</th>
                                <th>Activate Date</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($investArr as $key=> $t )  
                            <tr>
                                <td>@php echo $key+1; @endphp</td>
                                <td>@php echo $t->userData->username; @endphp</td>
                                <td>@php echo $t->currencyData->name; @endphp</td>
                                <td>@php echo number_format($t['amount'],2); @endphp</td>
                                <td>@php echo $t['created_at']; @endphp</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
</div>
@section('footerScript')
<script type="text/javascript">
    $(".investPackage").click(function(){
        var investAmt   = $("#investAmt").val();
        if (confirm('Are you sure you want to invest with : '+investAmt)) {
            $.ajax({ 
                url: "/investPackage",
                data:{ 
                    "investAmt":investAmt
                },
                type: 'POST',
                dataType: 'json',async: false,
                success: function(res)
                { 
                    if(res.type=="success"){
                        $.toaster({ priority : 'success', title : 'Invest Alert !', message : res.msg});
                        setTimeout(function () {
                                window.location.href = webLink+"package-history";
                        }, 5000);
                    }else{
                        $.toaster({ priority : 'danger', title : 'Invest Alert !', message : res.msg});
                    }
                    
                }
            });
        }
    }); 
</script>

@endsection
@include('adminCommon.footer')