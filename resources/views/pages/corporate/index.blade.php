@extends('layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title" style="text-transform: capitalize">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                        <i class="mdi mdi-hospital-building"></i>
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
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-4" style="justify-content: space-between">
                                <div class="col-auto">
                                    <h4 class="card-title">List Corporate </h4>
                                </div>
                                <div class="col-auto">
                                    <button id="addCorporate" class="btn btn-sm btn-success" disabled>+ Add Corporate</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 table-responsive py-2">
                                    <table id="datatable" class="table align-items-center dt-responsive nowrap dataTable no-footer">
                                        <thead>
                                            <tr role="row">
                                                <th>No</th>
                                                <th>Corporate Name</th>
                                                <th>Position</th>
                                                <th>Join At</th>
                                                <th>Resign At</th>
                                                <th>Job Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal" tabindex="-1" data-backdrop="static" aria-labelledby="modal-showLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content p-2">
                    <form class="forms-modal" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-showLabel"></h5>
                            <button id="dismiss" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="corporate_id" name="corporate_id">
                            <input type="hidden" id="current" name="current">
                            <div class="form-group">
                                <label for="name">Corporate Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                                <label id="name_error" class="error mt-2 text-danger d-none" for="name"></label>
                            </div>
                            <div class="form-group">
                                <label for="position">Position</label>
                                <input type="text" class="form-control" id="position" name="position" required>
                                <label id="position_error" class="error mt-2 text-danger d-none" for="position"></label>
                            </div>
                            <div class="form-group row mb-0">
                                <div id="col-join" class="col">
                                    <label for="join_at">Join At</label>
                                    <input type="text" class="form-control joindate datetimepicker-input" id="join_at" name="join_at" data-toggle="datetimepicker" data-target=".joindate" autocomplete="off" required>
                                    <label id="join_at_error" class="error mt-2 text-danger d-none" for="join_at"></label>
                                </div>
                                <div id="col-resign" class="col">
                                    <label for="resign_at">Resign At</label>
                                    <input type="text" class="form-control resigndate datetimepicker-input" id="resign_at" name="resign_at" data-toggle="datetimepicker" data-target=".resigndate" autocomplete="off" required>
                                    <label id="resign_at_error" class="error mt-2 text-danger d-none" for="resign_at"></label>
                                </div>
                            </div>
                            <div class="form-check mb-4">
                                <label class="form-check-label">
                                    <input id="current_work" type="checkbox" class="form-check-input"> 
                                    Current work <i class="input-helper"></i>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="job_description">Job Description</label>
                                <textarea id="jobdesc" class="my-desc form-control" name="jobdesc" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="dismiss" type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                            <button type="Submit" class="btn btn-gradient-primary btn-submit"></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        @include('includes.footer')
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/content/corporate.js')}}"></script>
@endpush
