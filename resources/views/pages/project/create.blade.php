@extends('layouts.app')

@push('styles')
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <link href="{{ asset('css/select2.min.css')}}" rel="stylesheet" />
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
                        <form id="store-form">
                            <div class="card-body">
                                <div class="row mb-1">
                                    <div class="col">
                                        <h4 class="card-title mb-0">New Project</h4>
                                        <p class="card-subtitle m-0">Create new project</p>
                                    </div>
                                </div>
                                <hr class="horizontal dark">
                                <input type="hidden" id="current" name="current">
                                <div class="row">
                                    <div class="col-12 mt-2">
                                        <div class="form-group">
                                            <label for="tags">Corporate</label>
                                            <span class="form-text text-muted text-sm">
                                                Project for corporate!
                                            </span>
                                            <select name="corporate_id" id="corporate_id" class="form-control b-radius-75" required>
                                                <option value="" disabled>-- Select One --</option>
                                                @foreach ($corporates as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3 mt-2">
                                        <div class="form-group">
                                            <label for="name">Project Name</label>
                                            <input type="text" class="form-control" id="name" name="name">
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3 mb-2">
                                        <div class="input-group mb-2">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="thumbnail" name="thumbnail" aria-describedby="thumbnail" accept="image/*">
                                                <label class="custom-file-label" for="thumbnail"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="previewImg" class="col-auto position-relative mb-4 d-none">
                                        <img id="img-fluid" class="img-fluid" alt="image" width="200">
                                        <div id="btn_delete_file" class="btn btn-danger btn-photo"
                                            style="right: 0; top: -10px">
                                            <i class='mdi mdi-delete icon' ></i>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="form-group">
                                            <label for="tags">Tags</label>
                                            <span class="form-text text-muted text-sm">
                                                This input are skill for build projects!
                                            </span>
                                            <select class="tags-multiple select2-hidden-accessible" name="tags[]" multiple="multiple" style="width:100%" required></select>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="form-group mb-2">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="tags">Start At</label>
                                                    <input type="text" class="form-control b-radius-075 datetimepicker-input" id="start_at" name="start_at" data-toggle="datetimepicker" data-target="#start_at" autocomplete="off" required>
                                                </div>
                                                <div class="col-6">
                                                    <label for="tags">Finish At</label>
                                                    <input type="text" class="form-control b-radius-075 datetimepicker-input" id="finish_at" name="finish_at" data-toggle="datetimepicker" data-target="#finish_at" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-check mt-1 mb-4">
                                            <label class="form-check-label">
                                                <input id="project_active" type="checkbox" name="project_active" class="form-check-input"> 
                                                Project Active <i class="input-helper"></i>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="form-group">
                                            <label for="description">Job Description</label>
                                            <span class="form-text text-muted text-sm">
                                                This is how others will learn about the project, so make it good!
                                            </span>
                                            <textarea id="description" class="form-control b-radius-075" name="description" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <button id="btn_submit" type="submit" class="btn btn-primary"></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <script src="{{ asset('panel/js/select2.min.js')}}"></script>
    <script src="{{ asset('js/content/create-project.js')}}"></script>
    
@endpush