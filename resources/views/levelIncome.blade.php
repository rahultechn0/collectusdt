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
        <h3 class="mb-30 fw600 mb-3">Level Income</h3>
    </div>

        <div class="card shadow cardtable">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S No</th>
                                <th>Level Type</th>
                                <th>Team Size</th>
                                <th>Team Business</th>
                                <th>Level Income</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($levelArr as $key=> $level )
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>Level {{ $key+1 }}</td>
              
                                <td><b>{{ $level['levelCnt'] }}</b></td> 
                                <td><b>${{ number_format( $level['business'],2) }}</b></td>
                                @if(isset($levelTrans[$key]['amount']))
                                <td><b>${{ number_format( $levelTrans[$key]['amount'],2) }}</b></td>                                        
                                @else
                                <td><b>0.00</b></td>    
                                @endif          
                                         
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