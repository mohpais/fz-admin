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
                            <div class="form-group">
                                <label for="name">Skill Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                                <label id="name_error" class="error mt-2 text-danger d-none" for="name"></label>
                            </div>
                            {{-- <div class="form-group">
                                <label>Select Icon</label>
                                <select class="form-control" id="icon" name="icon">
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div> --}}
                            <div class="form-group">
                                <label for="icon">Icon</label>
                                <input type="text" class="form-control" id="icon" name="icon" required>
                                <label id="icon_error" class="error mt-2 text-danger d-none" for="icon"></label>
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
    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            
            // Initial Variable
            var ModalNames = $('#modal'),
                ModalForms = $('.forms-modal'),
                ModalLabels = $('#modal-showLabel')
                ModalButton = $('.btn-submit')

            // Datatables config
            var table = $('#datatable').DataTable({
                destroy: true,
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('list.skill') }}"
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {
                        data: 'icon', 
                        name: 'icon', 
                        orderable: false, 
                        searchable: false
                    },
                    {
                        data: 'c_at', 
                        name: 'c_at', 
                        orderable: false, 
                        searchable: false
                    },
                    {
                        data: 'action', 
                        name: 'action', 
                        orderable: false, 
                        searchable: false
                    },
                ],
                initComplete: function( settings, json){
                    if (json) {
                        $('#addSkill').prop('disabled', false)
                    }
                },
                aLengthMenu: [[5, 10, 25, 50, 75, -1], [5, 10, 25, 50, 75, "All"]],
                pageLength: 5
            })

            /* Modal Add Experience */
            $('#addSkill').on('click', function() {
                openModal(true, 'Add Skill', 'create-skill', 'Create')
            });

            if (ModalForms.length > 0) {
                ModalForms.validate({
                    submitHandler: function(form) {
                        var btnId = ModalButton.attr('id')
                        let spinner = `
                            <div class="spinner-border spinner-border-sm" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        `
                        ModalButton.html(`${spinner} Sending ...`);
                        $.ajax({
                            data: ModalForms.serialize(),
                            url: "{{ route('store.skill') }}",
                            type: "POST",
                            dataType: 'json',
                            success: function (response) {
                                // console.log(response);
                                var {success, message, data} = response
                                closeModal(true);
                                if (success) {
                                    Swal.fire('Success!', message, 'success')
                                } else {
                                    Swal.fire({icon: 'error', title: 'Oops...', text: 'Something went wrong!'})
                                }
                                var oTable = $('#datatable').dataTable();
                                oTable.fnDraw(false);
                            },
                            error: async function (err) {
                                btnId === 'create-skill' ? ModalButton.html('Create') : ModalButton.html('Update');

                                const {message} = err.responseJSON;

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: message
                                })

                                console.log('Error:', err);
                            }
                        });
                    }
                })
            }
    
            function openModal(resetForms, titleModal, buttonId, buttonTitle) {
                if (resetForms) ModalForms.trigger("reset");
                // fetchIcon();
                ModalLabels.html(titleModal);
                ModalButton.attr('id', buttonId).html(buttonTitle);
                ModalNames.modal('show');
                $("html").addClass("overflow-hidden")
            }

            function closeModal(resetForms) {
                if (resetForms) ModalForms.trigger("reset");
                ModalNames.modal('hide');
                $("html").removeClass("overflow-hidden")
            }

            // function fetchIcon() {
            //     $.ajax({
            //         dataType: "json",
            //         url: 'json/mdi-icons.json',
            //         success: function(response) {
            //             var items = [];
            //             $.each( response, function( index, data ) {
            //                 let value = data.name,
            //                     // text = `<i class="mdi mdi-${value}"></i>`,
            //                     text = `<svg height="12" width="12">
            //                                 <path d="${data.path}" />
            //                             </svg>`,
            //                     options = `<option id="${value}" value="${value}"></option>`
            //                 // items.push( "<option id='" + key + "'>" + val + "</li>" );
            //                 // console.log(text);
            //                 $('select#icon').append(options);
            //                 $(`option#${value}`).append(text);
            //             });
                        
            //             // $( "<ul/>", {
            //             //     "class": "my-new-list",
            //             //     html: items.join( "" )
            //             // }).appendTo( "body" );
            //             // $('select#icon').append(`<option value="${optionValue}">
            //             //     ${optionText}
            //             // </option>`);
            //         }
            //     });
            // }
        })
    </script>
@endpush
