$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    
    // var groups_array = [];

    // $.getJSON(url_get_data, function (data) {
    //     console.log(data);
    //     $.each(data, function (index) {
    //         groups_array.push({
    //             id: data[index].ProcurementStatusID,
    //             text: data[index].Description,
    //         });
    //     });

    // }).done(function (data) {
    //     console.log(data);
    //     // $("#ddlStatus").val(1).trigger("change");
    // });
    // // console.log(groups_array);

    $.ajax({
        url: url_get_data,
        type: "get",
        dataType: 'json',
        success: function (response) {
            console.log(response);
            // var {success, message, data} = response
            // closeModal(true);
            // if (success) {
            //     Swal.fire('Success!', message, 'success')
            // } else {
            //     Swal.fire({icon: 'error', title: 'Oops...', text: 'Something went wrong!'})
            // }
            // var oTable = $('#datatable').dataTable();
            // oTable.fnDraw(false);
        },
        error: async function (err) {
            // btnId === 'create-skill' ? ModalButton.html('Create') : ModalButton.html('Update');

            // const {message} = err.responseJSON;

            // Swal.fire({
            //     icon: 'error',
            //     title: 'Oops...',
            //     text: message
            // })

            console.log('Error:', err);
        }
    });
});

// function fillDropdownReference(id, grouptype) {
//     var groups_array = [];

//     $.getJSON(
//         url_get_reference_dropdown,
//         {
//             reference_type: grouptype,
//         },
//         function (data) {
//             $.each(data, function (index) {
//                 groups_array.push({
//                     id: data[index].id,
//                     text: data[index].value,
//                 });
//             });

//             $(id).select2({
//                 placeholder: "Please select one",
//                 allowClear: true,
//                 data: groups_array,
//             });
//         }
//     );

//     $(id).val(null).trigger("change");
// }
