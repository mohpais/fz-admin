$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    setDatePicker('.joindate')
    setDatePicker('.resigndate');

    $('.my-desc').ckeditor();
    
    $('.form-check').on('click', function() {
        if ($('#current_work').is(":checked")) {
            $('#current_work').attr('checked', false)
        } else {
            $('#current_work').attr('checked', true)
        }
        checkCheckbox()
    })


    function checkCheckbox() {
        if ($('#current_work').is(":checked")) {
            $('#current').val(1);
            $("#col-resign").addClass("d-none")
        } else {
            $('#current').val(0);
            $("#col-resign").removeClass("d-none")
        }
    }
    $('#addCorporate').prop('disabled', true);

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
            url: "{{ route('corporates.index') }}"
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'position', name: 'position'},
            {
                data: 'join_at', 
                name: 'join_at', 
                orderable: false, 
                searchable: false
            },
            {
                data: 'resign_at', 
                name: 'resign_at', 
                orderable: false, 
                searchable: false
            },
            {
                data: 'jobdesc', 
                name: 'jobdesc',
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
                $('#addCorporate').prop('disabled', false)
            }
        },
        aLengthMenu: [[5, 10, 25, 50, 75, -1], [5, 10, 25, 50, 75, "All"]],
        pageLength: 5
    })

    $('#dismiss').on('click', closeModal)

    /* Modal Add Experience */
    $('#addCorporate').on('click', function() {
        openModal(true, 'Add Corporate', 'create-corporate', 'Create')
    });

    
    /* Edit Experience */
    $('body').on('click', '.editCorporate', function () {
        // Get id form attribut a edit
        var corporate_id = $(this).data('id');
        $.ajax({
            url: "{{ url('corporates') }}" + `/${corporate_id}/edit`,
            type: "GET",
            success: function(response){
                openModal(true, 'Edit Corporate', 'update-corporate', 'Update')
                // Fill input with data edit
                $('#corporate_id').val(response.id);
                $('#current').val(response.current);
                $('#name').val(response.name);
                $('#position').val(response.position);
                $('#join_at').val(convertDate(response.join_at));
                $('#resign_at').val(convertDate(response.resign_at));
                $('.my-desc').ckeditor().val(response.jobdesc);
                if (!response.current) {
                    $('#current_work').attr('checked', false)
                } else {
                    $('#current_work').attr('checked', true)
                }
                checkCheckbox()
            },
            error: function(err) {
                console.log(err);
            }
        })
    });

    /* Delete Experience*/
    $('body').on('click', '.deleteCorporate', function () {
        var corporate_id = $(this).data("id");
        if (!corporate_id) return
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
                    url: "{{ url('corporates') }}" + "/" + corporate_id,
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
                    url: "{{ route('corporates.store') }}",
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
                        btnId === 'create-corporate' ? ModalButton.html('Create') : ModalButton.html('Update');

                        const {message} = err.responseJSON;

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: message
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
        checkCheckbox();
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