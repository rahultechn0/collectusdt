@include("adminCommon/header")
<body>


  
<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="{{ route('index') }}"><img src="{{asset('bitsair/img/logo.png')}}"/></a>


    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <i class="fa fa-bars" aria-hidden="true"></i>
    </button>


    <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto ">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('index') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link border-menu" href="{{ route('login') }}">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link border-menu" href="{{ route('register') }}">Register</a>
        </li>
      </ul> 
    </div>
  </div>
</nav> 