@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/mail.css')}}">
@endpush

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title" style="text-transform: capitalize">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                        <i class="mdi mdi-archive"></i>
                    </span> 
                    {{ str_replace('.', ' ', Route::currentRouteName()) }}
                </h3>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb bg-transparent">
                        <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body message">
                            <div class="sender-details">
                                <div class="details">
                                    <h4 class="msg-subject ellipsis mb-1"> {{$messages->subject}} ({{date('M d, Y', strtotime($messages->created_at))}})</h4>
                                    <p class="sender-email"> 
                                        {{$messages->name}} <a href="#">{{$messages->email}}</a> &nbsp;<i class="mdi mdi-account-multiple-plus"></i>
                                    </p>
                                </div>
                            </div>
                            <div class="message-content">
                                {!! $messages->body !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('includes.footer')
    </div>
@endsection

@push('scripts')
    <script type="text/javascript"></script>
@endpush