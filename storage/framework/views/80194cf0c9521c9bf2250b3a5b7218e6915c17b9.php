<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- Always force latest IE rendering engine -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	 <title>Collect USDT: Automated Crypto Investing While Explore</title>
    <link href="<?php echo e(asset('html/img/favicon.ico')); ?>" rel="icon">
    <link rel="stylesheet" href="<?php echo e(asset('html/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('html/css/font-awesome-4.7.0/css/font-awesome.min.css')); ?>">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
	 <link href="https://fonts.googleapis.com/css2?family=Jost:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="<?php echo e(asset('html/css/owl.carousel.min.css')); ?>" rel="stylesheet">
    <link rel=" stylesheet" href="<?php echo e(asset('html/css/style.css')); ?>">
	
</head>
<body>
 
    <nav class="navbar navbar-expand-lg">
	<div class="container">
        <!-- logo -->
        <a class="navbar-brand" href="index">
        <img src="<?php echo e(asset('html/img/logo.png')); ?>" alt="header-Logo" class="logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText">
            <span class="icon-bar"><i class="fa fa-bars fa-2x"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav ml-auto line">
			 <li class="nav-item">
                    <a class="nav-link active" href="/">Home</a> 
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/">About Us</a>
                </li>
               
               
               <li class="nav-item">
                    <a class="nav-link" href="/">Live Trading </a>
                </li> 
				<li class="nav-item">
                    <a class="nav-link" href="/">Features</a>
                </li> 	
              <li class="nav-item">
                    <a class="nav-link" href="faq">FAQ</a>
                </li> 				
				<li class="nav-item">
                    <a class="nav-link" href="#contact" data-scroll-nav="5">Contact</a>
                </li>
				<li class="nav-item">
                    <a class="btn btn-hover" href="login" >Login</a>
                </li>
				<li class="nav-item">
                    <a class="btn " href="register" >Sign Up</a>
                </li>
            </ul>
          
        </div>
		
		</div>
       
    </nav>

<section class="login_page">
  <div class="container h-custom">

    <div class="row d-flex justify-content-center  ">

    

      <div class="col-md-8 col-lg-7 col-xl-5 ">
      <div class="login_box">
          <?php if(Session::has('message')): ?>
            <p class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?>"><?php echo e(Session::get('message')); ?></p>
          <?php endif; ?>
      <?php echo e(Form::open(array('url' => 'loginIn', "method"=>"POST", 'autocomplete'=>"off"))); ?>



          <div class="divider d-flex align-items-center mb-20">
            <h4 class="text-center fw-bold  mb-3">Login</h4>
          </div>
          <div class="form-outline mb-3">
            <?php echo Form::text('email',old('email'),[ "class"=>"form-control","id"=>"email","placeholder"=>"Email Address or Username" ] ); ?>

            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>
          <div class="form-outline mb-3">
            <?php echo Form::password('password',[ "class"=>"form-control","id"=>"password","placeholder"=>"Enter Password" ] ); ?>

            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>  

          <div class="d-flex justify-content-between align-items-center">
            <div class="form-check mb-0">
              <?php echo Form::checkbox('remberme',1,null,[ "class"=>"form-check-input me-2","id"=>"remberme" ] ); ?>

              <?php echo Form::label("remberme","Remember me"); ?>

            </div>
            <a href="#" class="forget">Forgot password?</a>
          </div>

          <div class="text-center text-lg-start pt-2">
            <?php echo Form::submit("Login",["class"=>"btn btn-lg w130"] ); ?>

            <p class="small mt-2 pt-1 mb-0">Don't have an account? <a href="<?php echo e(route('register')); ?>"class="link-danger">Register</a></p>
          </div>

        </form>
      </div>
      </div>


    </div>
  </div>
  </section>
   <section class="contact padding footer" id="contact" data-scroll-index="5">
        <div class="container">
            <div class="row">
				<div class="col-md-4">
                   <img src="<?php echo e(asset('html/img/logo.png')); ?>" alt="header-Logo" class="logo">
				   
				     <a class="btn certificate" target="_blank" href="<?php echo e(asset('html/certificate.pdf')); ?>" >Company Certificate</a>
			    </div>
				<div class="col-md-8"><div class="row">
			 <div class="col-md-6 ">
			     <div class="nav_link">
				 <h4>Social Media</h4>
			   <ul class="vertical-social">
				<li><a target="_blank" href="#"><i class="fa fa-telegram" ></i>Telegram</a></li>
				<li><a target="_blank" href="#"><i class="fa fa-facebook" ></i>Facebook</a></li>
				<li><a target="_blank" href="#"> <i class="fa fa-twitter" ></i>Twitter</a></li>
				<li><a target="_blank" href="#"><i class="fa fa-linkedin" ></i>Linkedin</a></li>
				</ul>            
             </div>
			 </div>
			 
			  <div class="col-md-4">
			     <div class="nav_link">
				 <h4>Company</h4>
				<ul>
				<li><a href="faq">FAQ</a></li>
				<li><a href="#">Terms & Conditions</a></li>
				<li><a href="#">Privacy Policy</a></li>
				
				</ul>                  
             </div>
			 </div>
			 </div>
			 </div>
              
            </div>
        </div>
    
	
	<div class="copyright">
                       &copy; 2022 Collect Usdt. All Rights Reserved
                    </div>
    </section>

    <script src="<?php echo e(asset('html/js/jquery-3.3.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset('html/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('html/js/scrollIt.min.js')); ?>"></script>
    <script src="<?php echo e(asset('html/js/jquery.countTo.js')); ?>"></script>
    <script src="<?php echo e(asset('html/js/owl.carousel.min.js')); ?>"></script>
    <script src="<?php echo e(asset('html/js/main.js')); ?>"></script>

  


</body>

</html><?php /**PATH /home/techno/collectusdt/resources/views/login.blade.php ENDPATH**/ ?>