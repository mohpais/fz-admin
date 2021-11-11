@extends('layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title" style="text-transform: capitalize">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                        <i class="mdi mdi-contacts"></i>
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
                                    <h4 class="card-title">List Skill</h4>
                                </div>
                                <div class="col-auto">
                                    <button id="addSkill" class="btn btn-sm btn-success" disabled>+ Add Skill</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 table-responsive py-2">
                                    <table id="datatable" class="table align-items-center dt-responsive nowrap dataTable no-footer">
                                        <thead>
                                            <tr role="row">
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Icon</th>
                                                <th>Created At</th>
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
        @include('partials.modal-skill')
        <!-- content-wrapper ends -->
        @include('includes.footer')
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/content/skill.js')}}"></script>
@endpush
