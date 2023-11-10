@include('partials.header')
<body class="container-fluid bg-login">
<div class="container">

    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5 rounded-3">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              {{-- <div class="col-lg-6 d-none d-lg-block bg-lgn-image rounded-start"></div> --}}
              <div class="col-lg-12">
                <div class="p-5">
                    <div class="text-center">
                      <h1 class="h4 text-gray-900 mb-4">Register</h1>
                    </div>
                    <form class="user" action="{{ route('postsignup') }}" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter First Name">
                          <label for="floatingInput">First Name</label>
                          @if ($errors->has('first_name'))
                            <span class="text-danger">{{ $errors->first('first_name') }}</span>
                          @endif
                        </div>
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter Last Name">
                          <label for="floatingInput">Last Name</label>
                          @if ($errors->has('last_name'))
                            <span span class="text-danger">{{ $errors->first('last_name') }}</span>
                          @endif
                        </div>
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username">
                          <label for="floatingInput">Username</label>
                          @if ($errors->has('username'))
                          <span span class="text-danger">{{ $errors->first('username') }}</span>
                        @endif
                        </div>
                        <div class="form-floating mb-3">
                          <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
                          <label for="floatingPassword">Password</label>
                          @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                          @endif
                        </div>
                      
                        <div class="d-grid gap-2 mt-3">
                            <button class="btn btn-primary btn-lg rounded-5" type="submit" id="btnSave"><b>Sign Up</b></button>
                        </div>    
                    </form>
                    <br/>
  
                    <hr>
                    <div class="text-center">
                        <p class="text-muted text-center">&copy <?php echo date("Y");?> Laravel<br/>CISSD</p>
                    </div>
                </div>
                
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

</div>
</body>  
@include('partials.footer')



{{-- <li class="nav-item">
  <a href="javascript:void(0);" data-placement="bottom" rel="popover-focus" data-offset="300" data-toggle="popover-custom"
      class="nav-link">
      Mega Menu
      <i class="fa fa-angle-down ml-2 opacity-5"></i>
  </a>
  <div class="rm-max-width">
      <div class="d-none popover-custom-content">
          <div class="dropdown-mega-menu">
              <div class="grid-menu grid-menu-3col">
                  <div class="no-gutters row">
                      <div class="col-sm-6 col-xl-4">
                          <ul class="nav flex-column">
                              <li class="nav-item-header nav-item"> Overview</li>
                              <li class="nav-item">
                                  <a href="javascript:void(0);" class="nav-link">
                                      <i class="nav-link-icon lnr-inbox"></i>
                                      <span> Contacts</span>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="javascript:void(0);" class="nav-link">
                                      <i class="nav-link-icon lnr-book"></i>
                                      <span> Incidents</span>
                                      <div class="ml-auto badge badge-pill badge-danger">5</div>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="javascript:void(0);" class="nav-link">
                                      <i class="nav-link-icon lnr-picture"></i>
                                      <span> Companies</span>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a disabled href="javascript:void(0);" class="nav-link disabled">
                                      <i class="nav-link-icon lnr-file-empty"></i>
                                      <span> Dashboards</span>
                                  </a>
                              </li>
                          </ul>
                      </div>
                      <div class="col-sm-6 col-xl-4">
                          <ul class="nav flex-column">
                              <li class="nav-item-header nav-item"> Favourites</li>
                              <li class="nav-item">
                                  <a href="javascript:void(0);" class="nav-link"> Reports Conversions </a>
                              </li>
                              <li class="nav-item">
                                  <a href="javascript:void(0);" class="nav-link"> Quick Start
                                      <div class="ml-auto badge badge-success">New</div>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="javascript:void(0);" class="nav-link">Users &amp; Groups</a>
                              </li>
                              <li class="nav-item">
                                  <a href="javascript:void(0);" class="nav-link">Proprieties</a>
                              </li>
                          </ul>
                      </div>
                      <div class="col-sm-6 col-xl-4">
                          <ul class="nav flex-column">
                              <li class="nav-item-header nav-item">Sales &amp; Marketing</li>
                              <li class="nav-item">
                                  <a href="javascript:void(0);" class="nav-link">Queues </a>
                              </li>
                              <li class="nav-item">
                                  <a href="javascript:void(0);" class="nav-link">Resource Groups </a>
                              </li>
                              <li class="nav-item">
                                  <a href="javascript:void(0);" class="nav-link">Goal Metrics
                                      <div class="ml-auto badge badge-warning">3</div>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="javascript:void(0);" class="nav-link">Campaigns</a>
                              </li>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</li> --}}
