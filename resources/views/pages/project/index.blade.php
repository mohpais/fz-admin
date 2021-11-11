@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/portfolio.css')}}">
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
                        <div class="card-body">
                            <div class="row mb-1">
                                <div class="col">
                                    <h4 class="card-title mb-0">List Project</h4>
                                    <p class="card-subtitle m-0">Create new project</p>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row portfolio-grid">
                                        @forelse ($projects as $item)
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                                <figure class="effect-text-in">
                                                    <img src="{{ $item->thumbnail }}" alt="image">
                                                    <figcaption>
                                                        <h4>{{$item->name}}</h4>
                                                        <p class="d-flex">
                                                            <button class="col-4 m-0 btn btn-sm bg-transparent text-white" style="border: none">
                                                                <i class="mdi mdi-eye"></i>
                                                                open
                                                            </button>
                                                            <button class="col-4 m-0 btn btn-sm bg-transparent text-white" style="border: none">
                                                                <i class="mdi mdi-lead-pencil"></i>
                                                                edit
                                                            </button>
                                                            <button class="col-4 m-0 btn btn-sm bg-transparent text-white" style="border: none">
                                                                <i class="mdi mdi-delete"></i>
                                                                delete
                                                            </button>
                                                        </p>
                                                        {{-- <p class="d-flex justify-content-between">
                                                            <button class="col-auto btn btn-sm bg-transparent text-white" style="border: none">
                                                                <i class="mdi mdi-eye"></i>
                                                                open
                                                            </button>
                                                            <button class="col-auto btn btn-sm bg-transparent text-white" style="border: none">
                                                                <i class="mdi mdi-lead-pencil"></i>
                                                                edit
                                                            </button>
                                                        </p> --}}
                                                    </figcaption>
                                                </figure>
                                            </div>
                                        @empty
                                            
                                        @endforelse
                                        {{-- <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                            <figure class="effect-text-in">
                                                <img src="{{ asset('panel/images/projects/hipmi.jpeg') }}" alt="image">
                                                <figcaption>
                                                    <h4>HIPMINET</h4>
                                                    <p class="d-flex justify-content-between">
                                                        <button class="col-auto btn btn-sm bg-transparent text-white" style="border: none">
                                                            <i class="mdi mdi-eye"></i>
                                                            open
                                                        </button>
                                                        <button class="col-auto btn btn-sm bg-transparent text-white" style="border: none">
                                                            <i class="mdi mdi-lead-pencil"></i>
                                                            edit
                                                        </button>
                                                    </p>
                                                </figcaption>
                                            </figure>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                            <figure class="effect-text-in">
                                                <img src="{{ asset('panel/images/projects/kadin.jpeg') }}" alt="image">
                                                <figcaption>
                                                    <h4>KADIN</h4>
                                                    <p class="d-flex justify-content-between">
                                                        <button class="col-auto btn btn-sm bg-transparent text-white" style="border: none">
                                                            <i class="mdi mdi-eye"></i>
                                                            open
                                                        </button>
                                                        <button class="col-auto btn btn-sm bg-transparent text-white" style="border: none">
                                                            <i class="mdi mdi-lead-pencil"></i>
                                                            edit
                                                        </button>
                                                    </p>
                                                </figcaption>
                                            </figure>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                            <figure class="effect-text-in">
                                                <img src="{{ asset('panel/images/projects/hipmi.jpeg') }}" alt="image">
                                                <figcaption>
                                                    <h4>HIPMINET</h4>
                                                    <p class="d-flex justify-content-between">
                                                        <button class="col-auto btn btn-sm bg-transparent text-white" style="border: none">
                                                            <i class="mdi mdi-eye"></i>
                                                            open
                                                        </button>
                                                        <button class="col-auto btn btn-sm bg-transparent text-white" style="border: none">
                                                            <i class="mdi mdi-lead-pencil"></i>
                                                            edit
                                                        </button>
                                                    </p>
                                                </figcaption>
                                            </figure>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                            <figure class="effect-text-in">
                                                <img src="{{ asset('panel/images/projects/kadin.jpeg') }}" alt="image">
                                                <figcaption>
                                                    <h4>KADIN</h4>
                                                    <p class="d-flex justify-content-between">
                                                        <button class="col-auto btn btn-sm bg-transparent text-white" style="border: none">
                                                            <i class="mdi mdi-eye"></i>
                                                            open
                                                        </button>
                                                        <button class="col-auto btn btn-sm bg-transparent text-white" style="border: none">
                                                            <i class="mdi mdi-lead-pencil"></i>
                                                            edit
                                                        </button>
                                                    </p>
                                                </figcaption>
                                            </figure>
                                        </div>
                                        
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                            <figure class="effect-text-in">
                                                <img src="{{ asset('panel/images/projects/hipmi.jpeg') }}" alt="image">
                                                <figcaption>
                                                    <h4>HIPMINET</h4>
                                                    <p class="d-flex justify-content-between">
                                                        <button class="col-auto btn btn-sm bg-transparent text-white" style="border: none">
                                                            <i class="mdi mdi-eye"></i>
                                                            open
                                                        </button>
                                                        <button class="col-auto btn btn-sm bg-transparent text-white" style="border: none">
                                                            <i class="mdi mdi-lead-pencil"></i>
                                                            edit
                                                        </button>
                                                    </p>
                                                </figcaption>
                                            </figure>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                            <figure class="effect-text-in">
                                                <img src="{{ asset('panel/images/projects/kadin.jpeg') }}" alt="image">
                                                <figcaption>
                                                    <h4>KADIN</h4>
                                                    <p class="d-flex justify-content-between">
                                                        <button class="col-auto btn btn-sm bg-transparent text-white" style="border: none">
                                                            <i class="mdi mdi-eye"></i>
                                                            open
                                                        </button>
                                                        <button class="col-auto btn btn-sm bg-transparent text-white" style="border: none">
                                                            <i class="mdi mdi-lead-pencil"></i>
                                                            edit
                                                        </button>
                                                    </p>
                                                </figcaption>
                                            </figure>
                                        </div> --}}
                                    </div>
                                </div>
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
    <script type="text/javascript">
    </script>
@endpush