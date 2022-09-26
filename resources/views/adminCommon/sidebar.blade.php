<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        
        <div class="sidebar-brand-text mx-3">
		<img class="logo1" src="{{ asset('html/img/logo-dashboard.png')}}"/>
		<img class="logo2" src="{{asset('html/img/logo_icon.png')}}"/>
		</div>
        </a>
        
        <hr class="sidebar-divider my-0">
    
        <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard')}}">
        <i class="fa fa-tachometer" aria-hidden="true">
        </i> <span>Dashboard</span></a>
        </li>
		
		<li class="nav-item ">
        <a class="nav-link" href="{{ route('account')}}">
        <i class="fa fa-user-circle-o" aria-hidden="true">
        </i> <span>Account</span></a>
        </li>

       

    
        
        
         @if( (Auth::user()) && ( Auth::user()->id == 1 ) )
            <li class="nav-item">
                <a class="nav-link" href="{{ route('userlist')}}">
                    <i class="fa fa-tachometer" aria-hidden="true"></i><span>User Management</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('withdrawalreq')}}">
                    <i class="fa fa-tachometer" aria-hidden="true"></i><span>Withdrawal Request</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('withdraw-history')}}">
                    <i class="fa fa-tachometer" aria-hidden="true"></i><span>Withdrawal History</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('package-report')}}">
                    <i class="fa fa-tachometer" aria-hidden="true"></i><span>Package Report</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('level-report')}}">
                    <i class="fa fa-tachometer" aria-hidden="true"></i><span>Level Report</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('referral-report')}}">
                    <i class="fa fa-tachometer" aria-hidden="true"></i><span>Referral Report</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('rank-report')}}">
                    <i class="fa fa-tachometer" aria-hidden="true"></i><span>Rank Report</span>
                </a>
            </li>
        @else 

            <li class="nav-item ">
            <a class="nav-link" href="{{ route('wallet')}}">
            <i class="fa fa-tachometer" aria-hidden="true">
            </i> <span>Wallet</span></a>
            </li>
                <li class="nav-item ">
            <a class="nav-link" href="{{ route('wallet-history')}}">
            <i class="fa fa-tachometer" aria-hidden="true">
            </i> <span>Wallet History</span></a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{ route('package-history')}}">
            <i class="fa fa-history" aria-hidden="true"></i>
            <span>Package History</span></a>
            </li>
            <li class="nav-item ">
            <a class="nav-link" href="{{ route('levelIncome')}}">
            <i class="fa fa-user-circle-o" aria-hidden="true">
            </i> <span>Level Income</span></a>
            </li>
            <li class="nav-item ">
            <a class="nav-link" href="{{ route('stakIncome')}}">
            <i class="fa fa-user-circle-o" aria-hidden="true">
            </i> <span>Staking Income</span></a>
            </li>
            <li class="nav-item ">
            <a class="nav-link" href="{{ route('rankIncome')}}">
            <i class="fa fa-user-circle-o" aria-hidden="true">
            </i> <span>Rank Income</span></a>
            </li>
            <li class="nav-item ">
            <a class="nav-link" href="{{ route('referralIncome')}}">
            <i class="fa fa-user-circle-o" aria-hidden="true">
            </i> <span>Referral Income</span></a>
            </li>

            
            <li class="nav-item ">
            <a class="nav-link" href="{{ route('network')}}">
            <i class="fa fa-tachometer" aria-hidden="true">
            </i> <span>Network</span></a>
            </li>
         @endif
 

        <li class="nav-item">
        <a class="nav-link" href="{{ route('logout')}}">
        <i class="fa fa-lock" aria-hidden="true"></i>
        <span>Logout</span></a>
        </li> 
 

        <hr class="sidebar-divider d-none ">

        <!--<div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
        </div>-->

    </ul>