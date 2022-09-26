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
                <div class="container-fluid">
                <!-- Page Heading -->
                    <div class="heading ">
                        <h3 class="mb-30 text-gray-800 font-weight-bold">Stake</h3>
                    </div>

                    @if(Session::has('message'))
                      <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-lg-4 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-lg font-weight-bold tab text-success text-uppercase mb-1"><button class="tablinks" onclick="openCity(event, 'Crypto')">Crypto</button></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-lg-4 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-lg font-weight-bold tab text-info text-uppercase mb-1">
                                            <button class="tablinks cha" onclick="openCity(event, 'DAO')">DAO</button>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 


                    </div>
            </div>
            <!-- End of Main Content -->



    
    

    <div class="container-fluid pb-70">
        <div class="row align-items-center">
        <div class="col-lg-12">
        <div class="card shadow">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S No</th>
                                <th>Token</th>
                                <th>Price(INR)</th>
                                <th class="apyTitle">APY(%)</th>
                                <th>Locking Period</br>(in month)</th>
                                <th>Balance</th>
                                <th>Stake Now</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach( $currencyData as $key=> $c )

                            @php
                                $balance = App\Models\Transaction::where("user_id",$userData['id'])->where("currency_id",$c['id'])->where("status","Success")->sum("amount");
                            @endphp


                              <tr class="@php echo $c['c_type']; @endphp">
                                  <td>@php echo $c['s_no']; @endphp</td>
                                  <td><img src="{{ asset('bitsair/img/'.$c['image']) }}" alt=""> @php echo $c['name']; @endphp</td>
                                  <td>@php echo $c['price']; @endphp</td>
                                  <td>@php echo $c['apy']; @endphp</td>                                  
                                  <td>@php echo $c['lockingPeriod']; @endphp</td>
                                  <td>@php echo $balance; @endphp</td>
                                  <td><button data-currency="@php echo $c['id']; @endphp" class="btn btn-stake stakeNow">Stake Now</button></td>
                              </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
            </div>

    </div>
    </div> 
@include('adminCommon.footer')

<script>

openCity(event,"Crypto");
function openCity(evt, cityName) {  
  if(cityName=="DAO"){
    var matched = $(".DAO");
    $(".apyTitle").html("APY %");
    $(".Crypto").addClass("d-none");
    $(".DAO").removeClass("d-none"); 
  }else{
    $(".apyTitle").html("APR %");
    $(".DAO").addClass("d-none");
    $(".Crypto").removeClass("d-none"); 
  }
}
</script>