<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle ml-3">
    <i class="fa fa-bars" aria-hidden="true"></i>
</button>


<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">
    <div class="topbar-divider d-none d-sm-block"></div>
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small">@php echo $userData->username; @endphp</span>
        <img class="img-profile rounded-circle"src="{{ asset('collect-usdt/img/undraw_profile.svg')}}"></a>
		
		<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
		  <li><a class="dropdown-item" href="{{ route('account')}}">
        <i class="fa fa-user-circle-o" aria-hidden="true">
        </i> <span>Account</span></a> </li>
		 <li><a class=" dropdown-item" href="{{ route('logout')}}">
        <i class="fa fa-lock" aria-hidden="true"></i>
        <span>Logout</span></a> </li>
		 </ul>
	  
    </li>

	
</ul>

</nav>
<!-- End of Topbar -->