@extends('layouts.auth')

@section('authform')
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                {{-- Sekolah Logo Image --}}
                <div class="logo text-center mt-5">
                    <img src="{{ asset('adminpanel/assets/static/images/logo/sekolah-logo.png') }}" alt="Sekolah Logo"
                        width="120px" height="128px">
                </div>
                <div id="auth-left">
                    <h1 class="text-center">Login</h1>
                    <p class="mb-5 text-center">
                        Silahkan login untuk melanjutkan.
                    </p>

                    <form action="{{ route('auth.authenticate') }}" method="POST" data-parsley-validate>
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" class="form-control form-control-xl" name="email" placeholder="Email"
                                required />
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" name="password"
                                placeholder="Password" required />
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
                            Login
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right"></div>
            </div>
        </div>
    </div>
@endsection
