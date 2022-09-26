<?php echo $__env->make('adminCommon.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
    <?php echo $__env->make('adminCommon.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->



            <div id="content">
            <?php echo $__env->make('adminCommon.topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="heading ">
                        <h3 class="mb-30 text-gray-800 font-weight-bold">Profile</h3>
                    </div>

                    <?php if(Session::has('message')): ?>
                <p class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?>"><?php echo e(Session::get('message')); ?></p>
            <?php endif; ?>

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
            <?php echo Form::open(["url"=>"saveProfile","autocomplete"=>"off","method"=>"POST"]); ?>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-outline mb-3">
                            <?php echo e(Form::label("fname","Full Name")); ?>

                            <?php echo Form::text("fname",$userData['fname'],["class"=>"form-control","id"=>"fname"]); ?>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-outline mb-3">
                            <?php echo e(Form::label("username","Username")); ?>

                            <?php echo Form::text("username",$userData['username'],["class"=>"form-control","id"=>"username","readonly"=>"readonly"]); ?>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-outline mb-3">
                            <?php echo e(Form::label("email","Email Address")); ?>

                            <?php echo Form::text("email",$userData['email'],["class"=>"form-control","id"=>"email","readonly"=>"readonly"]); ?>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="text-right text-lg-start">
                            <?php echo Form::input("submit","Save","Update Profile", ["class"=>"btn  btn_d"]); ?>

                        </div>
                    </div>
                </div>
            <?php echo Form::close(); ?>

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
  
      <?php echo Form::open(["url"=>"saveWalletAddressErc20","autocomplete"=>"off","method"=>"POST"]); ?>

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
           <?php echo Form::close(); ?>

    </div>
    <div id="TRC20_tab" class=" tab-pane fade">
     <?php echo Form::open(["url"=>"saveWalletAddressTrc20","autocomplete"=>"off","method"=>"POST"]); ?>

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
           <?php echo Form::close(); ?>

    </div>
    <div id="BEP20_tab" class=" tab-pane fade">
        <?php echo Form::open(["url"=>"saveWalletAddressBep20","autocomplete"=>"off","method"=>"POST"]); ?>

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
           <?php echo Form::close(); ?>

    </div>
  </div>
		
        </div>
        </div>
    </div>

    <div id="changePassword" class="tabcontent">
        <div class="profile-form pb-60">
            <?php echo Form::open(["url"=>"changePassword","autocomplete"=>"off","method"=>"POST"]); ?>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-outline mb-3">
                            <?php echo e(Form::label("username","Username")); ?>

                            <?php echo Form::text("username",$userData['username'],["class"=>"form-control","id"=>"username","readonly"=>"readonly"]); ?>

                            
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-outline mb-3">
                            <?php echo e(Form::label("oldPass","Old Password")); ?>

                            <?php echo Form::password("oldPass",["class"=>"form-control","id"=>"oldPass","required"=>"required"]); ?>

                            <?php $__errorArgs = ['oldPass'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-danger"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-outline mb-3">
                            <?php echo e(Form::label("newPass","New Password")); ?>

                            <?php echo Form::password("newPass",["class"=>"form-control","id"=>"newPass","required"=>"required"]); ?>

                            <?php $__errorArgs = ['newPass'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-danger"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-outline mb-3">
                            <?php echo e(Form::label("cPass","Confirm Password")); ?>

                            <?php echo Form::password("cPass",["class"=>"form-control","id"=>"cPass","required"=>"required"] ); ?>

                            <?php $__errorArgs = ['cPass'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-danger"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="text-right text-lg-start">
                            <?php echo Form::input("submit","Save","Update Password", ["class"=>"btn  btn_d"]); ?>

                        </div>
                    </div>
                </div>
            <?php echo Form::close(); ?>

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
                        <?php $__currentLoopData = $loginhistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><?php echo $history['last_login_at'];?></td>
                            <td><?php echo $history['created_at'];?></td> 
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>


 </div>
            </div>







    


<script>
    <?php if(Session::has('div_account')): ?>
        openCity(event, '<?php echo e(Session::get('div_account')); ?>');

    <?php else: ?>
        openCity(event, 'profile');
    <?php endif; ?> 
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





<?php echo $__env->make('adminCommon.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/techno/collectusdt/resources/views/account.blade.php ENDPATH**/ ?>