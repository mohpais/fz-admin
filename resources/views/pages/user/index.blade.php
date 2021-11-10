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
                                    <h4 class="card-title">Data table</h4>
                                </div>
                                <div class="col-auto">
                                    <button id="addUser" class="btn btn-sm btn-success" disabled>+ Add User</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 table-responsive py-2">
                                    <table id="datatable" class="table align-items-center dt-responsive nowrap dataTable no-footer">
                                        <thead>
                                            <tr role="row">
                                                <th>No</th>
                                                <th>Photo</th>
                                                <th>Fullname</th>
                                                <th>Email</th>
                                                <th>Username</th>
                                                <th>Number Phone</th>
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
                <div class="modal-content">
                    <form class="forms-modal" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-showLabel"></h5>
                            <button id="dismiss" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="user_id" name="user_id">
                            <div class="form-group">
                                <label for="fullname">Full Name</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Full Name" required>
                                <label id="fullname_error" class="error mt-2 text-danger d-none" for="fullname"></label>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" required>
                                <label id="email_error" class="error mt-2 text-danger d-none" for="email"></label>
                            </div>
                            <div class="form-group">
                                <label for="username">User Name</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Full Name" required>
                                <label id="username_error" class="error mt-2 text-danger d-none" for="username"></label>
                            </div>
                            <div class="form-group">
                                <label for="username">Number Phone</label>
                                <input type="telp" class="form-control" id="phone" name="phone" placeholder="Number Phone" required>
                                <label id="phone_error" class="error mt-2 text-danger d-none" for="phone"></label>
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
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            
            $('#addUser').prop('disabled', true);

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
                    url: "{{ route('users.index') }}"
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {
                        data: 'photo', 
                        name: 'photo',
                        orderable: false, 
                        searchable: false
                    },
                    {data: 'fullname', name: 'fullname'},
                    {data: 'email', name: 'email'},
                    {data: 'username', name: 'username'},
                    {data: 'phone', name: 'phone'},
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
                        $('#addUser').prop('disabled', false)
                    }
                }
            })

            $('#dismiss').on('click', closeModal)

            /* Modal Add Experience */
            $('#addUser').on('click', function() {
                openModal(true, 'Add User', 'create-user', 'Create')
            });

            
            /* Edit User */
            $('body').on('click', '.editUser', function () {
                // Get id form attribut a edit
                var user_id = $(this).data('id');
                $.ajax({
                    url: "{{ url('users') }}" + `/${user_id}/edit`,
                    type: "GET",
                    success: function(response){
                        openModal(true, 'Edit User', 'update-user', 'Update')
                        // Fill input with data edit
                        $('#user_id').val(response.id);
                        $('#fullname').val(response.fullname);
                        $('#email').val(response.email);
                        $('#username').val(response.username);
                        $('#phone').val(response.phone);
                    },
                    error: function(err) {
                        console.log(err);
                    }
                })
            });

            /* Delete Experience*/
            $('body').on('click', '.deleteUser', function () {
                var user_id = $(this).data("id");
                if (!user_id) return
                Swal.fire({
                    title: 'Are you sure want to delete?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ url('users') }}" + "/" + user_id,
                            success: function (data) {
                                if (data.success) {
                                    Swal.fire(
                                        'Deleted!',
                                        'Data has been deleted.',
                                        'success'
                                    )
                                    var oTable = $('#datatable').dataTable(); 
                                    oTable.fnDraw(false);
                                }
                            },
                            error: async function (err) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong!'
                                })
                                const e = await err;

                                console.log('Error:', e);
                            }
                        });
                        
                    }
                })
            })

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
                            url: "{{ route('users.store') }}",
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
                                btnId === 'create-user' ? ModalButton.html('Create') : ModalButton.html('Update');
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong!'
                                })
                                // const {errors} = err.responseJSON;
                                // for (const [key, value] of Object.entries(errors)) {
                                //     console.log(`${key}: ${value}`);
                                //     $(`#${key}_error`).removeClass('d-none').html(value)
                                //     $(`input#${key}`).addClass('is-invalid')
                                // }
                                // setTimeout(() => {
                                //     for (const [key, value] of Object.entries(errors)) {
                                //         $(`#${key}_error`).addClass('d-none').html(value)
                                //         $(`input#${key}`).removeClass('is-invalid')
                                //     }
                                // }, 3000);

                                console.log('Error:', err);
                            }
                        });
                    }
                })
            }


            /** 
            * Convert date for input date
            */
            function convertDate(date) {
                if (!date) 
                    return date

                var dt = new Date(date)
                var day = ("0" + dt.getDate()).slice(-2);
                var month = ("0" + (dt.getMonth() + 1)).slice(-2);

                return dt.getFullYear()+"-"+(month)+"-"+(day) ;
            }

            function openModal(resetForms, titleModal, buttonId, buttonTitle) {
                if (resetForms) ModalForms.trigger("reset");
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


        })
    </script>
@endpush
