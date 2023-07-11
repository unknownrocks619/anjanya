@extends('themes.studio.studio')

@section('content')

  <div class="container-fluid p-0">
    <div class="row m-0">
      <div class="col-12 p-0">
        <div class="login-card">
          <div>
            <div>
                <a class="logo text-center" href="index.html">
                    <img class="img-fluid for-light" src="../assets/images/logo/logo.png" alt="logo image">
                </a>
            </div>
            <div class="login-main">
              <form action="{{route('registration.user.store')}}" method="POST" class="theme-form ajax-form">
                <h2 class="text-center">Create your account</h2>
                <p class="text-center">Enter your personal details to create account</p>
                <div class="form-group">
                  <label class="col-form-label pt-0">Your Name</label>
                </div>
                <div class="row g-2">
                    <div class="col-6">
                        <div class="form-group">
                            <input class="form-control" type="text" required="" name="first_name" placeholder="First name" />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                          <input class="form-control" type="text" aria-required="true" name="last_name" placeholder="Last name" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                  <label class="col-form-label">Email Address</label>
                  <input class="form-control" name="email" type="email" placeholder="Test@gmail.com">
                </div>
                <div class="form-group">
                  <label class="col-form-label">Password</label>
                  <div class="form-input position-relative">
                    <input class="form-control show-password" name="password" type="password" name="login[password]" required="" placeholder="*********">
                    <div class="show-hide"><span class="show"></span></div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="checkbox p-0">
                    <input id="checkbox1" name='terms' value='1' type="checkbox">
                    <label class="text-muted" class="terms"  for="checkbox1">Agree with<a class="ms-2" href="javascript:void(0)">Privacy Policy</a></label>
                  </div>
                  <button class="btn btn-primary btn-block w-100 mt-3" type="submit">Create Account</button>
                </div>
                <p class="mt-4 mb-0 text-center">Already have an account?<button class="m-0 p-0 btn btn-link d-inline button-click" data-href="{{route('login',['_ref' =>'registration'])}}">Sign in</button></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
