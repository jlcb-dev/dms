@include('partials.header')

<body class="container-fluid bg-login">
    <div class="container">

        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5 rounded-3">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-lgn-image rounded-start"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!!</h1>
                                    </div>
                                    @if (\Session::has('message'))
                                        <div class="alert alert-warning">
                                            {{ \Session::get('message') }}
                                        </div>
                                    @endif
                                    <form class="user" action="{{ route('postlogin') }}" method="POST">
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="username" name="username"
                                                placeholder="Enter username">
                                            <label for="floatingInput">Username</label>
                                            @if ($errors->has('username'))
                                                <span class="text-danger">{{ $errors->first('username') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-floating">
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="Enter Password">
                                            <label for="floatingPassword">Password</label>
                                            @if ($errors->has('password'))
                                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                        <div class="d-grid gap-2 mt-3">
                                            <button class="btn btn-primary btn-lg rounded-5" type="submit"
                                                id="btn_login"><b>Login</b></button>
                                        </div>
                                    </form>
                                    <br />

                                    <hr>
                                    <div class="text-center">
                                        <p class="text-muted text-center">&copy <?php echo date('Y'); ?> Laravel<br />CISSD
                                        </p>
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
