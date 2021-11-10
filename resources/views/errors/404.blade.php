@extends('layouts.app')

@push('styles')
    <style>
        .error-page h1 {
            font-size: 8.7rem !important;
        }
        .error-page-divider h3 {
            font-size: 1.26rem;
        }
    </style>
@endpush

@section('content')
@auth
    <div class="main-panel">
@else
    <div class="container-fluid page-body-wrapper full-page-wrapper px-0">
@endauth
        <div class="content-wrapper d-flex align-items-center text-center error-page bg-primary">
            <div class="row flex-grow">
                <div class="col-lg-7 mx-auto text-white">
                <div class="row align-items-center d-flex flex-row">
                    <div class="col-lg-6 text-lg-right pr-lg-4">
                    <h1 class="display-1 mb-0">404</h1>
                    </div>
                    <div class="col-lg-6 error-page-divider text-lg-left pl-lg-4">
                    <h2>SORRY!</h2>
                    <h3 class="font-weight-light">The page you’re looking for was not found.</h3>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-12 text-center mt-xl-2">
                        @auth
                            <a class="text-white font-weight-medium" href="{{ URL::previous() }}">Redirect Back</a>
                            {{-- <a class="text-white font-weight-medium" href="{{route('dashboard.index')}}">Back to Dahshboard</a> --}}
                        @else
                            <a class="text-white font-weight-medium" href="{{route('login')}}">Back</a>
                        @endauth
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-12 mt-xl-2">
                    <p class="text-white font-weight-medium text-center">Copyright © 
                        <?php echo date("Y"); ?>
                        All rights reserved.</p>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
@endsection