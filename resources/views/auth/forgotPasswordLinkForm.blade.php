@extends('theme.masterLayout')

@section("title", "Reset Password")

@section('content')

<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Reset password</p>

                <form class="mx-1 mx-md-4" action="{{ route('password.forgot.link.submit') }}" method="post">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <!--need to keep session for login user-->
                    @session('error')
                      <div class="alert alert-danger">{{ $value }}</div>
                    @endsession
                    <!--need to keep session for forget password-->
                    @session('success')
                      <div class="alert alert-success">{{ $value }}</div> 
                    @endsession

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                      <input type="email" id="form3Example3c" name="email" class="form-control" value="{{ old('email') }}" />
                      <label class="form-label" for="form3Example3c">Your Email</label>

                       <!--if error happened in email input--> 
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        even using old() previous password not saved.
                      <input type="password" id="form3Example4c" name="password" class="form-control" value="" />
                      <label class="form-label" for="form3Example4c">Password</label>

                       <!--if error happened in password input--> 
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                  </div>

                  <!--confirm password-->
                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        
                      <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" value="" />
                      <label class="form-label" for="password_confirmation">Confirm Password</label>

                       <!--if error happened in password input--> 
                        @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                  </div>

                  <!--
                  <div class="form-check d-flex justify-content-center mb-5">
                    <input class="form-check-input me-2" type="checkbox" name="remember" value="true" id="form2Example3c" />
                    <label class="form-check-label" for="form2Example3">
                      Remember Me
                    </label>
                  </div> -->

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg">Reset Password</button>
                  </div>

                </form>

                <div class="row">
                  <div class="col-12">
                    <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-center mt-5">
                      <a href="{{ route('register') }}" class="link-secondary text-decoration-none"> Create new account</a>
                      <a href="{{ route('password.forgot') }}" class="link-secondary text-decoration-none">Forgot password</a>
                    </div>
                  </div>
                </div>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                  class="img-fluid" alt="Sample image">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


@endsection