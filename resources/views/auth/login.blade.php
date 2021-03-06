@extends('layouts.app')

@push('styles')
    <style>
        .form-group.password {
            position: relative;
        }

        .form-group.password .btn:hover i{
            color: #9b9b9b;
        }

        .form-group.password .btn i{
            color: #b9b9b9;
        }

        .form-group.password .btn{
            position: absolute;
            padding-left: 10px;
            padding-right: 10px;
            top: 3px;
            right: 6px;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left p-5">
                        <div class="brand-logo">
                            <img src="{{ asset('panel/images/logo.svg')}}">
                        </div>
                        <h4>Hello! let's get started</h4>
                        <h6 class="font-weight-light">Sign in to continue.</h6>
                        <form id="form-login" class="pt-3" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group password">
                                <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="current-password">
                                <button type="button" id="openHide" class="btn"></button>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <button type="button" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">
                                    <i class="mdi mdi-login"></i>
                                    SIGN IN
                                </button>
                            </div>
                            <div class="my-2 d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Keep me signed in </label>
                                </div>
                            </div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="auth-link text-black">{{ __('Forgot Password?') }}</a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            var 
                showpass = 0,
                iconShow = '<i class="mdi mdi-eye"></i>',
                iconHide = '<i class="mdi mdi-eye-off"></i>',
                $btnLogin = $('.auth-form-btn'),
                $fromLogin = $('#form-login'),
                $inputPass = $('input#password'),
                $btnShowHide = $('button#openHide');

            $btnShowHide.click(function() {
                switch (showpass) {
                    case 0:
                        showpass = 1
                        $inputPass.attr('type', 'text')
                        break;
                    case 1:
                        showpass = 0
                        $inputPass.attr('type', 'password')
                    default:
                        break;
                }
                hideShow(showpass)
            })

            $btnLogin.on('click', function(e) {
                e.preventDefault();
                let spinner = `
                    <div class="spinner-border spinner-border-sm" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                `;
                $btnLogin.html(`${spinner} Please wait ...`);
                $btnLogin.prop('disabled', true);
                $fromLogin.submit();
            })

            function hideShow(flag) {
                if (flag === 0) {
                    $btnShowHide.html(iconShow)
                } else {
                    $btnShowHide.html(iconHide)
                }
            }

            hideShow(showpass)
        })
    </script>
@endpush