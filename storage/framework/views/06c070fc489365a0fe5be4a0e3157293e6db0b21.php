<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        
        <div class="sidebar-brand-text mx-3">
		<img class="logo1" src="<?php echo e(asset('html/img/logo-dashboard.png')); ?>"/>
		<img class="logo2" src="<?php echo e(asset('html/img/logo_icon.png')); ?>"/>
		</div>
        </a>
        
        <hr class="sidebar-divider my-0">
    
        <li class="nav-item active">
        <a class="nav-link" href="<?php echo e(route('dashboard')); ?>">
        <i class="fa fa-tachometer" aria-hidden="true">
        </i> <span>Dashboard</span></a>
        </li>
		
		<li class="nav-item ">
        <a class="nav-link" href="<?php echo e(route('account')); ?>">
        <i class="fa fa-user-circle-o" aria-hidden="true">
        </i> <span>Account</span></a>
        </li>

       

    
        
        
         <?php if( (Auth::user()) && ( Auth::user()->id == 1 ) ): ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('userlist')); ?>">
                    <i class="fa fa-tachometer" aria-hidden="true"></i><span>User Management</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('withdrawalreq')); ?>">
                    <i class="fa fa-tachometer" aria-hidden="true"></i><span>Withdrawal Request</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('withdraw-history')); ?>">
                    <i class="fa fa-tachometer" aria-hidden="true"></i><span>Withdrawal History</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('package-report')); ?>">
                    <i class="fa fa-tachometer" aria-hidden="true"></i><span>Package Report</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('level-report')); ?>">
                    <i class="fa fa-tachometer" aria-hidden="true"></i><span>Level Report</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('referral-report')); ?>">
                    <i class="fa fa-tachometer" aria-hidden="true"></i><span>Referral Report</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('rank-report')); ?>">
                    <i class="fa fa-tachometer" aria-hidden="true"></i><span>Rank Report</span>
                </a>
            </li>
        <?php else: ?> 

            <li class="nav-item ">
            <a class="nav-link" href="<?php echo e(route('wallet')); ?>">
            <i class="fa fa-tachometer" aria-hidden="true">
            </i> <span>Wallet</span></a>
            </li>
                <li class="nav-item ">
            <a class="nav-link" href="<?php echo e(route('wallet-history')); ?>">
            <i class="fa fa-tachometer" aria-hidden="true">
            </i> <span>Wallet History</span></a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('package-history')); ?>">
            <i class="fa fa-history" aria-hidden="true"></i>
            <span>Package History</span></a>
            </li>
            <li class="nav-item ">
            <a class="nav-link" href="<?php echo e(route('levelIncome')); ?>">
            <i class="fa fa-user-circle-o" aria-hidden="true">
            </i> <span>Level Income</span></a>
            </li>
            <li class="nav-item ">
            <a class="nav-link" href="<?php echo e(route('stakIncome')); ?>">
            <i class="fa fa-user-circle-o" aria-hidden="true">
            </i> <span>Staking Income</span></a>
            </li>
            <li class="nav-item ">
            <a class="nav-link" href="<?php echo e(route('rankIncome')); ?>">
            <i class="fa fa-user-circle-o" aria-hidden="true">
            </i> <span>Rank Income</span></a>
            </li>
            <li class="nav-item ">
            <a class="nav-link" href="<?php echo e(route('referralIncome')); ?>">
            <i class="fa fa-user-circle-o" aria-hidden="true">
            </i> <span>Referral Income</span></a>
            </li>

            
            <li class="nav-item ">
            <a class="nav-link" href="<?php echo e(route('network')); ?>">
            <i class="fa fa-tachometer" aria-hidden="true">
            </i> <span>Network</span></a>
            </li>
         <?php endif; ?>
 

        <li class="nav-item">
        <a class="nav-link" href="<?php echo e(route('logout')); ?>">
        <i class="fa fa-lock" aria-hidden="true"></i>
        <span>Logout</span></a>
        </li> 
 

        <hr class="sidebar-divider d-none ">

        <!--<div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
        </div>-->

    </ul><?php /**PATH /home/techno/collectusdt/resources/views/adminCommon/sidebar.blade.php ENDPATH**/ ?>