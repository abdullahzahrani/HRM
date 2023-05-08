@extends('layouts.app')
@section('title', 'Login')

@section('content')
    <main>
        <div class="container">

            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center">
                                <a href="#" class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/logo.png" alt="">
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                        <p class="text-center small">Enter your username & password to login</p>
                                    </div>

                                    <form class="row g-3 needs-validation" novalidate method="POST"
                                          action="{{ route('login') }}">
                                        @csrf
                                        <div class="col-12">
                                            <label for="email" class="form-label">Login Email</label>
                                            <div class="input-group has-validation">
                                                <input id="email" type="email"
                                                       class="form-control @error('email') is-invalid @enderror"
                                                       name="email" value="{{ old('email') }}" required
                                                       autocomplete="email" autofocus>

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                                <div class="invalid-feedback">Please enter your username.</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="password" class="form-label">Password</label>
                                            <input id="password" type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   name="password" required autocomplete="current-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                            <div class="invalid-feedback">Please enter your password!</div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-danger w-100" type="submit">Login</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Don't have Permission?</p>
                                            <p>
                                                {{--                                                @if (Route::has('password.request'))--}}
                                                <a href="#">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                                {{--                                                @endif--}}
                                            </p>
                                            <a href="#">Login Help</a>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                        <footer id="footer" class="footer" style="margin-left: 0px;">
                            <div class="copyright">
                                &copy; Copyright <strong><span>BAE Systems</span></strong>. All Rights Reserved
                            </div>
                            <div class="credits">
                                Powered by <a href="#">SDT</a>
                            </div>
                        </footer><!-- End Footer -->
                    </div>

                </div>

            </section>

        </div>
    </main><!-- End #main -->
@endsection
