@include('partials.header')
<style>
    .remove {
        overflow: hidden;
    }
</style>

<div class="app-container body-tabs-shadow remove">
    <div class="app-container">
        <div class="h-100">
            <div class="h-100 no-gutters row">
                <div class="d-none d-lg-block col-lg-5">
                    <div class="slider-light">
                        <div class="slick-slider">
                            <div>
                                <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-plum-plate"
                                    tabindex="-1">
                                    <div class="slide-img-bg"
                                        style="background-image: url('assets/images/originals/city.jpg');"></div>
                                    <div class="slider-content p-3 text-white text-uppercase fw-semibold">
                                        <h3>DMS</h3>
                                        <p>&nbsp;
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="h-100 d-flex bg-white justify-content-center align-items-center col-md-12 col-lg-7">
                    <div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9">
                        <div class="app-logo mb-4"><h3>Leads</h3></div>
                        <h4 class="mb-3">
                            <span class="d-block fw-bold">Welcome back!</span>
                            <span>Please sign in to your account.</span>
                        </h4>

                        <div class="">
                            <form class="user" action="{{ route('postlogin') }}" method="POST">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-8">
                                        @if (\Session::has('message'))
                                            <div class="alert alert-warning">
                                                {{ \Session::get('message') }}
                                            </div>
                                        @endif
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="username" name="username"
                                                placeholder="Enter username">
                                            <label for="floatingInput">Username</label>
                                            @if ($errors->has('username'))
                                                <span class="text-danger">{{ $errors->first('username') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="Enter Password">
                                            <label for="floatingPassword">Password</label>
                                            @if ($errors->has('password'))
                                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-8 mt-3">
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-primary btn-lg rounded-3 fw-semibold px-5 shadow p-2"
                                                type="submit" id="btn_login"><h5>Login</h5></button>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="position-relative form-check">
                                    <input name="check" id="exampleCheck" type="checkbox" class="form-check-input">
                                    <label for="exampleCheck" class="form-check-label">Keep me logged in</label>
                                </div> --}}

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials.footer')
