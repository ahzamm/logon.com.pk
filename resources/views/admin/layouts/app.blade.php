<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @include('admin.partial.styles')
  @stack('style')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    {{-- <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="squadcloud.co" role="button" title="change password">
          <i class="fas fa-key"></i>
        </a>
      </li>
      <li class="nav-item" title="logout">
        <a class="nav-link" href="" title="logout" onclick="event.preventDefault();document.getElementById('logout-form').submit();" role="button">
          <i class="fas fa-sign-out-alt"></i>
        </a>
        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
          @csrf
      </form>
      </li>
    </ul> --}}

    <ul class="navbar-nav ml-auto">
      @php
      $userProfile  = Auth::user()->image ;
      @endphp
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          @if(  $userProfile == null )
          <i class="fas fa-user"></i>
          @else
          <img src="{{asset('admin/dist/img/' . $userProfile )}}" alt="Your Name" class="img-fluid img-thumbnail rounded" style="height: 30px;object-fit:cover;">
          @endif
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" data-toggle="modal" data-target="#cvModal"><span><i class="fa-regular fa-address-card"></i></span> User Profile</a>
          <a class="dropdown-item" href="#" id="btnShowCP" role="button" title="Change Password" data-toggle="modal" data-target="#changePasswordModal"><span><i class="fas fa-unlock-alt"></i></span> Change Password</a>
        </div>
      </li>
    </ul>

  </nav>
  <!-- /.navbar -->

  {{-- User profile modal --}}
  <div class="modal fade" id="cvModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-md modal-sm" role="document">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h3>User Profile</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="insertProfile" action="{{route('user.profile.update',Auth::user()->id)}}" method="post" enctype="multipart/form-data">
          @csrf
          <!-- Modal Body -->
          <div class="modal-body">
            <div class="container-fluid">
              <div class="row">
                <!-- Left Side (Image) -->
                <div class="col-md-4 col-sm-12 text-center">
                  @if(  $userProfile == null )
                  <img src="{{ asset('admin/dist/img/default_uesr_pic.png') }}" style="height: 150px; object-fit: cover;" alt="Your Name" class="img-fluid img-thumbnail rounded">
                  @else
                  <img src="{{asset('admin/dist/img/' . $userProfile )}}" alt="Your Name" class="img-fluid img-thumbnail rounded" style="height: 220px;object-fit:cover;">
                  @endif
                  <input type="file" class="mt-2" name="image">
                </div>
                <!-- Right Side (Input Fields) -->
                <div class="col-md-8 ">
                  <div class="row">
                    <div class="form-group col-md-12">
                      <label for="fullName">Name</label>
                      <input type="text" class="form-control-plaintext" value="{{Auth::user()->name}}" id="fullName" name="user_name" placeholder="Enter your User Name" readonly>
                    </div>
                    <div class="form-group col-md-12">
                      <label for="email">Email Address</label>
                      <input type="email" class="form-control-plaintext" value="{{Auth::user()->email}}" id="email" name="email" placeholder="Enter your email" readonly>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  {{-- Change Password Modal --}}
  <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="alert bg-danger text-light pb-0" id="changePassError" style="display: none">
          </div>
          <form action="{{route('user.password.update')}}" method="post" id="changePassword" onsubmit="return validateForm()">
            @csrf
            <div class="form-group">
              <label for="oldpassword">Current Password <span style="color: red">*</span></label>
              <input type="password" name="oldpassword" id="oldpassword" class="form-control" placeholder="Enter Your Current Password" required>
            </div>
            <div class="form-group">
              <label for="newpassword">New Password <span style="color: red">*</span></label>
              <input type="password" name="newpassword" id="newpassword" class="form-control" placeholder="Password should be at least 8 characters long" required>
            </div>
            <div class="form-group">
              <label for="newpassword_confirmation">Confirm Password <span style="color: red">*</span></label>
              <input type="password" name="newpassword_confirmation" id="newpassword_confirmation" class="form-control" placeholder="Password should be at least 8 characters long" required>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-outline-primary" form="changePassword">Change Password</button>
        </div>
      </div>
    </div>
  </div>
  
  <script>
    function validateForm() {
      var newPassword = document.getElementById("newpassword").value;
      var confirmPassword = document.getElementById("newpassword_confirmation").value;
      var errorDiv = document.getElementById("changePassError");
  
      // Reset error display
      errorDiv.style.display = "none";
      errorDiv.innerHTML = "";
  
      if (newPassword.length < 8) {
        errorDiv.innerHTML = "New Password Password must be at least 8 characters long.";
        errorDiv.style.display = "block";
        return false;
      }
  
      if (newPassword !== confirmPassword) {
        errorDiv.innerHTML = "New Password and Confirm Password do not match.";
        errorDiv.style.display = "block";
        return false;
      }
  
      return true;
    }
  </script>
  



  @include('admin.partial.aside')

  @yield('content')

  <footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="http://logon.com.pk/" target="_blank">Logon Broadband (pvt) Ltd</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

</div>
<!-- ./wrapper -->
@include('admin.partial.scripts')
@stack('scripts')
</body>
</html>
