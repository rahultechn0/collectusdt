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
    <div class="heading">
       
        <h3 class="mb-30 fw600 mb-3">Team</h3>
    </div>
	<div class="row mb-2">
				 <div class="col-lg-4 mb-4">
                            <div class="card border-left-success shadow h-100 ">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class=" fw500 mb-1">
                                               Team Size</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">@php echo count($teamSize); @endphp</div>
                                        </div>
                                        <div class="col-auto">
										<span class="d_icon" >
                                          <i class="fa fa-users" aria-hidden="true"></i>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
				 <div class="col-lg-4 mb-4">
                            <div class="card border-left-success shadow h-100 ">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class=" fw500 mb-1">
                                                Team Business</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$@php echo number_format($teamBusiness,2); @endphp <small>USDT</small></div>
                                        </div>
                                        <div class="col-auto">
										<span class="d_icon" >
                                          <i class="fa fa-users" aria-hidden="true"></i>

                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
				
                        </div>
						
						
            <h3 class="mb-30 fw600 mb-3">My Level wise Team Size</h3>
            <div class="card shadow cardtable">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S No.</th>
                                <th>Level Type</th>
                                <th>Team Size</th>
                                <th>Get Detail</th>
                            </tr>
                        </thead>
                        <tbody>             
                            @foreach($levelArr as $key => $kk )
                               <tr>
                                <td>{{ $key+1 }}</td>
                                <td>Level @php echo ($key+1) ;@endphp</td>
                                <td>@php echo $kk;@endphp</td>
                                <td><a href="javascript:void(0)" class="getDetails" data-level="{{ $key+1 }}">Get Details</a></td>
                               </tr>
                            @endforeach                                                
                                                                                   
                             
                        </tbody>
                    </table> 
                </div>
            </div>
            <h3 class="mb-30 fw600 mt-3">My Level Team</h3>
            <div class="card shadow cardtable">
                <div class="table-responsive" id="directTeam">
                    
                </div>
            </div>
</div>
@section('footerScript')
    <style>
        .dis{ pointer-events: none;}
    </style>
    <script>
         $(".getDetails").click( function(){
            $(".getDetails").addClass("dis");
            var levelNo       = $(this).data("level");
            $.ajax({ 
                url: webLink+"get-team-info",
                data:{"levelNo":levelNo},
                dataType: 'json',
                type: 'POST',  
                success: function(result)
                { 
                    if(result.type =='success'){ 
                        $("#directTeam").html(result.table);
                        $(".getDetails").removeClass("dis");
                        
                        $(window).scrollTop($('#directTeam').offset().top);

                    }else if(result.type =='error'){
                        $("#directTeam").html("");
                        $(".getDetails").removeClass("dis");
                    }
                }
            });
        });
        setTimeout(function(){  $("#totalBusiness").html(); } , 500);
    </script>
@endsection
@include('adminCommon.footer')