@extends('auth.appauth')
@section('content')
    <div class="container" style="margin-top: -150px;">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8">
                <div id="login" style="border-radius: 5px;">
                    <div class="text-center"><img src="{{ asset('storage/css/site_logo.png') }}" alt="Image" width="160" height="34">
                    </div>
                    <div class="form-group text-center">
                    </div>
                    <hr>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group ">
                            <label>Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group ">
                            <label>Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="">
                            <div class="icheckbox_square-grey" style="position: relative;"><input type="checkbox" id="remember" name="remember" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                               {{ __('translate.Remember Me') }}
                            </label>
                        </div>
                        <button type="submit" class="btn_full ladda-button" data-style="expand-right">
                            <span class="ladda-label">{{ __('Login') }}</span><span class="ladda-spinner"></span>
                        </button>
                        @if (Route::has('password.request'))
                            <a class="btn_full_outline" style="text-decoration: none;" href="{{ route('password.request') }}">
                                {{ __('translate.Forgot Your Password?') }}
                            </a>
                        @endif
                    </form>
                        <a class="btn_full_outline" style="margin-top: 10px; text-decoration: none;" href="/register">
                            {{ __('translate.Registration') }}
                        </a>
                </div>
            </div>
        </div>
    </div>
@endsection
