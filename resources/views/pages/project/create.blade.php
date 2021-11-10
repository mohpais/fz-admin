@extends('layouts.app')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                        <form action="{{ route('projects.store') }}" method="POST">
                            @csrf
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
                                            <select name="corporate_id" id="corporate_id" class="form-control b-radius-75">
                                                <option value="" disabled>-- Select One --</option>
                                                @foreach ($corporates as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="name">Project Name</label>
                                            <input type="text" class="form-control b-radius-075" name="name" required>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="form-group">
                                            <label for="tags">Tags</label>
                                            <span class="form-text text-muted text-sm">
                                                This input are skill for build projects!
                                            </span>
                                            <select class="tags-multiple select2-hidden-accessible" name="tags[]" multiple="multiple" style="width:100%"></select>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="form-group mb-2">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="tags">Start At</label>
                                                    <input type="text" class="form-control b-radius-075 datetimepicker-input" id="start_at" name="join_at" data-toggle="datetimepicker" data-target=".joindate" autocomplete="off" required>
                                                </div>
                                                <div class="col-6">
                                                    <label for="tags">End At</label>
                                                    <input type="text" class="form-control b-radius-075 datetimepicker-input" id="end_at" name="join_at" data-toggle="datetimepicker" data-target=".joindate" autocomplete="off" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-check mt-1 mb-4">
                                            <label class="form-check-label">
                                                <input id="project_active" type="checkbox" class="form-check-input"> 
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Set datepicker
            setDatePicker('#start_at')
            setDatePicker('#end_at')

            // Set CKEditor
            $('#description').ckeditor();

            // Set multiple select
            // Tags
            $('.tags-multiple').select2({
                ajax: {
                    url: '/skill-resource',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

            // Set checkbox
            $('.form-check').on('click', function() {
                if ($('#project_active').is(":checked")) {
                    $('#project_active').attr('checked', false)
                } else {
                    $('#project_active').attr('checked', true)
                }
                checkCheckbox()
            })

            function checkCheckbox() {
                if ($('#project_active').is(":checked")) {
                    $('#current').val(1);
                    $("#end_at").addClass("d-none")
                } else {
                    $('#current').val(0);
                    $("#end_at").removeClass("d-none")
                }
            }
        })
    </script>
@endpush