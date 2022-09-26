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
                    <div class="heading ">
                        <h3 class="mb-30 text-gray-800 font-weight-bold">Profile</h3>
                    </div>

                    @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-lg-3 mb-3">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="p-0 p-md-4">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-lg font-weight-bold tab text-success text-uppercase mb-1"><button class="tablinks" onclick="openCity(event, 'profile')">Profile</button></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-lg-3 mb-3">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="p-0 p-md-4">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-lg font-weight-bold tab text-info text-uppercase mb-1">
                                            <button class="tablinks cha" onclick="openCity(event, 'changePassword')">Change Password</button>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        
                        <div class="col-lg-3 mb-3 d-none">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="p-0 p-md-4">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-lg font-weight-bold tab text-info text-uppercase mb-1">
                                            <button class="tablinks cha" onclick="openCity(event, 'security')">Security</button>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						 <div class="col-lg-3 mb-3">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="p-0 p-md-4">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-lg font-weight-bold tab text-info text-uppercase mb-1">
                                            <button class="tablinks cha" onclick="openCity(event, 'bank')">Wallet Address</button>
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
               
            <!-- End of Main Content --> 



    <div id="profile" class="tabcontent">
        <div class="profile-form pb-60">
            {!! Form::open(["url"=>"saveProfile","autocomplete"=>"off","method"=>"POST"]) !!}
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-outline mb-3">
                            {{ Form::label("fname","Full Name") }}
                            {!! Form::text("fname",$userData['fname'],["class"=>"form-control","id"=>"fname"]) !!}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-outline mb-3">
                            {{ Form::label("username","Username") }}
                            {!! Form::text("username",$userData['username'],["class"=>"form-control","id"=>"username","readonly"=>"readonly"]) !!}
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-outline mb-3">
                            {{ Form::label("email","Email Address") }}
                            {!! Form::text("email",$userData['email'],["class"=>"form-control","id"=>"email","readonly"=>"readonly"]) !!}
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="text-right text-lg-start">
                            {!! Form::input("submit","Save","Update Profile", ["class"=>"btn  btn_d"]) !!}
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>

    <div id="bank" class="tabcontent">
  <div class="w_box">
   <div class=" pb-60">
   <ul class="nav nav-tabs mb-4" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-bs-toggle="tab" href="#ERC20_tab">ERC20</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="tab" href="#TRC20_tab">TRC20</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="tab" href="#BEP20_tab">BEP20 </a>
    </li>
  </ul>
	

  <!-- Tab panes -->
 <div class="tab-content">
    <div id="ERC20_tab" class=" tab-pane active">
  
      {!! Form::open(["url"=>"saveWalletAddressErc20","autocomplete"=>"off","method"=>"POST"]) !!}
                <div class="row row align-items-end">
                     
                    <div class="col-lg-6">
                          <div class="form-outline mb-3 mb-lg-0">
                            <label for="b_name">Wallet Address</label>
                            <input class="form-control"  name="erc20" value="2" type="hidden">
                            <?php if(!isset($walletaddressDataerc['wallet_address']) || ($walletaddressDataerc['wallet_address']=="")){ ?>
                            <input class="form-control"  name="erc20_address" type="text" required>
                        <?php } else{?>
                           <input class="form-control"  name="erc20_address" type="text"  value="<?php if(isset($walletaddressDataerc['wallet_address'])){echo $walletaddressDataerc['wallet_address'];}?>" readonly>
                       <?php  }?>
                            </div>
                    </div>

                    <div class="col-lg-6">
                        <div class=" text-lg-start">
                          <input class="btn  btn_d" name="Save" type="submit" value="Add Address">
                        </div>
                    </div>
                </div>
           {!! Form::close() !!}
    </div>
    <div id="TRC20_tab" class=" tab-pane fade">
     {!! Form::open(["url"=>"saveWalletAddressTrc20","autocomplete"=>"off","method"=>"POST"]) !!}
                <div class="row row align-items-end">
                     
                    <div class="col-lg-6">
                          <div class="form-outline mb-3 mb-lg-0">
                            <label for="b_name">Wallet Address</label>
                            <input class="form-control"  name="trc20" value="1" type="hidden">
                            <?php if(!isset($walletaddressDatatrc['wallet_address']) || ($walletaddressDatatrc['wallet_address']=="")){ ?>
                            <input class="form-control"  name="trc20_address" type="text" required>
                        <?php } else{?>
                           <input class="form-control"  name="trc20_address" type="text"  value="<?php if(isset($walletaddressDatatrc['wallet_address'])){echo $walletaddressDatatrc['wallet_address'];}?>" readonly>
                       <?php  }?>
                            </div>
                    </div>

                    <div class="col-lg-6">
                        <div class=" text-lg-start">
                          <input class="btn  btn_d" name="Save" type="submit" value="Add Address">
                        </div>
                    </div>
                </div>
           {!! Form::close() !!}
    </div>
    <div id="BEP20_tab" class=" tab-pane fade">
        {!! Form::open(["url"=>"saveWalletAddressBep20","autocomplete"=>"off","method"=>"POST"]) !!}
                <div class="row row align-items-end">
                     
                    <div class="col-lg-6">
                          <div class="form-outline mb-3 mb-lg-0">
                            <label for="b_name">Wallet Address</label>
                            <input class="form-control"  name="bep20" value="3" type="hidden">
                            <?php if(!isset($walletaddressDatabep['wallet_address']) || ($walletaddressDatabep['wallet_address']=="")){ ?>
                            <input class="form-control"  name="bep20_address" type="text" required>
                        <?php } else{?>
                           <input class="form-control"  name="bep20_address" type="text"  value="<?php if(isset($walletaddressDatabep['wallet_address'])){ echo $walletaddressDatabep['wallet_address']; }?>" readonly>
                       <?php  }?>
                            </div>
                    </div>

                    <div class="col-lg-6">
                        <div class=" text-lg-start">
                          <input class="btn  btn_d" name="Save" type="submit" value="Add Address">
                        </div>
                    </div>
                </div>
           {!! Form::close() !!}
    </div>
  </div>
		
        </div>
        </div>
    </div>

    <div id="changePassword" class="tabcontent">
        <div class="profile-form pb-60">
            {!! Form::open(["url"=>"changePassword","autocomplete"=>"off","method"=>"POST"]) !!}
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-outline mb-3">
                            {{ Form::label("username","Username") }}
                            {!! Form::text("username",$userData['username'],["class"=>"form-control","id"=>"username","readonly"=>"readonly"]) !!}
                            
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-outline mb-3">
                            {{ Form::label("oldPass","Old Password") }}
                            {!! Form::password("oldPass",["class"=>"form-control","id"=>"oldPass","required"=>"required"]) !!}
                            @error('oldPass')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-outline mb-3">
                            {{ Form::label("newPass","New Password") }}
                            {!! Form::password("newPass",["class"=>"form-control","id"=>"newPass","required"=>"required"]) !!}
                            @error('newPass')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-outline mb-3">
                            {{ Form::label("cPass","Confirm Password") }}
                            {!! Form::password("cPass",["class"=>"form-control","id"=>"cPass","required"=>"required"] ) !!}
                            @error('cPass')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="text-right text-lg-start">
                            {!! Form::input("submit","Save","Update Password", ["class"=>"btn  btn_d"]) !!}
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div id="security" class="tabcontent">
        <div class="profile-form pb-60">
        <div class="w_box mb-4">
		  <h5>Two-Factor Authentication (2FA)</h5>
		  
		  <div class="row align-items-center mt-3">
		     <div class="col-md-6 col-lg-4 ">
		     <h6 >Google Authentication</h6>
		     </div>
			 <div class="col-md-4">
			<label class="switch">
			  <input type="checkbox" id="togBtn">
			  <div class="slider2"></div>
			</label>
		     </div>
		  </div>
		</div> 
		
		<div class="w_box mb-4">
		
		  <div class="row">
		  <div class="form-group col-lg-3">
		  <div class="kyc_bg">
		  <img class="img-fluid" src="https://cdn.pixabay.com/photo/2013/07/12/14/45/qr-code-148732_1280.png" alt="qrCode"></div>
		  </div>
		  <div class="form-group col-lg-7 pt-md-3">
		  <h5 class="kyc_h5">Key :<span> GZ6XE4Rfgngffgn6FBMEMFQ3K2NVYDAJRI</span> </h5>
		  <div class="form-group">
		    <label class="fw-500">Enter Auth Code</label>
		    <input type="text" class="form-control" name="vcode" placeholder="Enter Code" value="">
		  </div>
		  <div class="form-group">
		  <button class="btn  btn_d">Verify</button><p class="succTag"> </p></div>
		  </div></div>
		</div>
		 
		
        <div class="w_box">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S No</th>
                            <th>IP Address</th>
                            <th>Date & Time</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach( $loginhistory as $key=> $history )
                        <tr>
                            <td>@php echo $key+1; @endphp</td>
                            <td>@php echo $history['last_login_at'];@endphp</td>
                            <td>@php echo $history['created_at'];@endphp</td> 
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>


 </div>
            </div>







    


<script>
    @if(Session::has('div_account'))
        openCity(event, '{{ Session::get('div_account') }}');

    @else
        openCity(event, 'profile');
    @endif 
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>





@include('adminCommon.footer')