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
            url: "/skills"
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
                    url: "/skills/create",
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