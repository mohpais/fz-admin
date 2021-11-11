$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    var 
        file
        fd = new FormData(),
        $img = $('#img-fluid'),
        $form = $('#store-form'),
        $label = $('.custom-file-label'),
        $inputfile = $('#thumbnail'),
        $button = $('#btn_submit'),
        $priview = $('#previewImg'),
        $delPhoto = $('#btn_delete_file');
        
    $button.html('Create');
    $label.html('Thubmnail Project')
    $inputfile.on('change', function(e) {
        var 
            files = e.target.files,
            reader = new FileReader(),
            done = function (url) {
                // Preview Image Upload
                $priview.removeClass('d-none')
                $img.attr('src', url);
            };

        if (files && files.length > 0) {
            file = files[0];
            reader.onload = function (e) {
                done(e.target.result);
            };
            reader.readAsDataURL(file);
        }
    })

    /*
     * Button delete photo brows
    */
    $delPhoto.click(function() {
        file = null
        $priview.addClass('d-none')
        $img.removeAttr('src')
    })

    $button.click(function () {
        let spinner = `
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        `
        $button.html(`${spinner} Upload ...`);
        $button.prop('disabled', true);
        if (file && $form.length > 0) {
            // Append data 
            $form.validate({
                submitHandler: function() {
                    $button.html(`${spinner} Please wait ...`);
                    $button.prop('disabled', true);
                    // console.log($form.serializeArray());
                    fd.append('file', file);
                    let formData = $form.serializeArray();
                    for (let i = 0; i < formData.length; i++) {
                        const el = formData[i];
                        fd.append(el.name, el.value)
                    }
                    // fd.append('data', $form.serializeArray());
                    $.ajax({
                        data: fd,
                        url: "/projects",
                        type: "POST",
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function (response) {
                            console.log(response);
                            var {success, message, data} = response
                            if (success) {
                                Swal.fire('Success!', message, 'success')
                            } else {
                                Swal.fire({icon: 'error', title: 'Oops...', text: 'Something went wrong!'})
                            }
                            // $button.html('Create');
                            // $button.prop('disabled', false);
                            window.location.href = "http://localhost:8000/projects";
                        },
                        error: async function (err) {
                            const {message} = err.responseJSON;
    
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: message
                            })
                            window.location.reload();
                        }
                    });
                }
            })
            // AJAX request 
            // $.ajax({
            //     url: "/profile/upload",
            //     type: "POST",
            //     data: fd,
            //     contentType: false,
            //     processData: false,
            //     dataType: 'json',
            //     success: function(response){
            //         var {success, message} = response
            //         if (success) {
            //             Swal.fire('Success!', message, 'success')
            //             window.location.reload()
            //         } else {
            //             Swal.fire({icon: 'error', title: 'Oops...', text: message})
            //         }
            //         $button.html(html);
            //         $button.prop('disabled', false);
            //     },
            //     error: async function(err){
            //         const {message} = err.responseJSON;
            //         Swal.fire({
            //             icon: 'error',
            //             title: 'Oops...',
            //             text: message
            //         })
            //         $button.html(html);
            //         $button.prop('disabled', false);
            //     }
            // });
        } else {
            Swal.fire({icon: 'error', title: 'Oops...', text: "Please select a file."})
        }
    })
    // if ($form.length > 0) {
    //     $form.validate({
    //         submitHandler: function() {
    //             $button.html(`${spinner} Please wait ...`);
    //             $button.prop('disabled', true);
    //             $.ajax({
    //                 data: form.serialize(),
    //                 url: "/projects",
    //                 type: "POST",
    //                 dataType: 'json',
    //                 success: function (response) {
    //                     // console.log(response);
    //                     var {success, message, data} = response
    //                     closeModal(true);
    //                     if (success) {
    //                         Swal.fire('Success!', message, 'success')
    //                     } else {
    //                         Swal.fire({icon: 'error', title: 'Oops...', text: 'Something went wrong!'})
    //                     }
    //                     var oTable = $('#datatable').dataTable();
    //                     oTable.fnDraw(false);
    //                 },
    //                 error: async function (err) {
    //                     btnId === 'create-skill' ? ModalButton.html('Create') : ModalButton.html('Update');

    //                     const {message} = err.responseJSON;

    //                     Swal.fire({
    //                         icon: 'error',
    //                         title: 'Oops...',
    //                         text: message
    //                     })

    //                     console.log('Error:', err);
    //                 }
    //             });
    //         }
    //     })
    // }
    // $button.click(function() {
    //     let spinner = `
    //         <div class="spinner-border spinner-border-sm" role="status">
    //             <span class="sr-only">Loading...</span>
    //         </div>
    //     `
    //     $button.html(`${spinner} Please wait ...`);
    //     $button.prop('disabled', true);
    // })
    
    // Set datepicker
    setDatePicker('#start_at')
    setDatePicker('#finish_at')

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