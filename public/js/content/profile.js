$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    var 
        $inputfile = $('#profile-img'),
        $reviewFile = $('#filepreview'),
        $avatarInit = $('.avatar-initial'),
        $delPhoto = $('#btn_delete_file'),
        $profileU = $('#profileUser'),
        $btnUpload = $('#btn_upload_profile'),
        input = ['fullname', 'email', 'phone', 'pod', 'bod', 'religion', 'marital'];
    // config datetimepicker
    for (const [key, value] of Object.entries(user)) {
        if (jQuery.inArray(key, input) !== -1) {
            var $inp = $(`input#${key}`)
            if (key === 'bod') {
                $('.birthday').datetimepicker({
                    format: "YYYY-MM-DD",
                    date: new Date(value)
                });
            } else {
                $(`input#${key}`).val(value) 
            }
        }
    }

    $('#printPDF').on('click', function(e) {
        e.preventDefault(); 
        $('#formGeneratePDF').submit();
    })

    $("#btn_brows_file").click(function() {
        var file,
            html = `<i class="mdi mdi-upload"></i> Upload`,
            fd = new FormData();
        $inputfile.trigger('click');
        $inputfile.on('change', function(e) {
            var 
                files = e.target.files,
                reader = new FileReader(),
                done = function (url) {
                    // Hidden avatar
                    if (!user.profile_photo_path) {
                        $avatarInit.addClass('d-none')
                    } else {
                        $profileU.addClass('d-none')
                        $profileU.removeClass('d-inline-block')
                    }
                    // Preview Image Upload
                    $reviewFile.removeClass('d-none')
                    $reviewFile.attr('src', url);

                    // Display button Upload
                    $btnUpload.removeClass('d-none')
                    $btnUpload.html(html)
                    // Show up delete button image
                    $("#btn_brows_file").css("visibility", "hidden")
                    $delPhoto.css('visibility', 'visible')
                };

            if (files && files.length > 0) {
                file = files[0];
                reader.onload = function (e) {
                    done(e.target.result);
                };
                reader.readAsDataURL(file);
            }
        })

        $btnUpload.click(function () {
            
            let spinner = `
                <div class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            `
            $btnUpload.html(`${spinner} Upload ...`);
            $btnUpload.prop('disabled', true);
            if (file) {
                // Append data 
                fd.append('file', file);
                fd.append('userID', user.id);
                // AJAX request 
                $.ajax({
                    url: "/profile/upload",
                    type: "POST",
                    data: fd,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response){
                        var {success, message} = response
                        if (success) {
                            Swal.fire('Success!', message, 'success')
                            window.location.reload()
                        } else {
                            Swal.fire({icon: 'error', title: 'Oops...', text: message})
                        }
                        $btnUpload.html(html);
                        $btnUpload.prop('disabled', false);
                    },
                    error: async function(err){
                        const {message} = err.responseJSON;
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: message
                        })
                        $btnUpload.html(html);
                        $btnUpload.prop('disabled', false);
                    }
                });
            } else {
                Swal.fire({icon: 'error', title: 'Oops...', text: "Please select a file."})
            }
        })

        /*
         * Button delete photo brows
        */
        $delPhoto.click(function() {
            if (!user.profile_photo_path) {
                $avatarInit.removeClass('d-none')
            } else {
                $profileU.addClass('d-inline-block')
                $profileU.removeClass('d-none')
            }
            $btnUpload.addClass('d-none')
            $reviewFile.addClass('d-none')
            $("#btn_brows_file").css("visibility", "visible")
            $delPhoto.css('visibility', 'hidden')
            $reviewFile.removeAttr('src')
        })
    })

    // var $inputfile = $('#profile-img'),
    //     $modal = $('#modal')

    // $("#btn_upload").click(function() {
    //     $inputfile.trigger('click');
    //     $inputfile.on('change', function(e) {
    //         var 
    //             url,
    //             cropper,
    //             file,
    //             reader,
    //             files = e.target.files,
    //             done = function (url) {
    //                 image.src = url;
    //                 $modal.modal('show');
    //             };
            
    //         if (files && files.length > 0) {
    //             file = files[0];
    //             if (URL) {
    //                 done(URL.createObjectURL(file));
    //             } else if (FileReader) {
    //                 reader = new FileReader();
    //                 reader.onload = function (e) {
    //                     done(reader.result);
    //                 };
    //                 reader.readAsDataURL(file);
    //             }
    //         }
            
    //         $modal.on('shown.bs.modal', function () {
    //             cropper = new Cropper(image, {
    //                 aspectRatio: 1,
    //                 viewMode: 4,
    //                 preview: '.preview'
    //             });
    //         }).on('hidden.bs.modal', function () {
    //             cropper.destroy();
    //             cropper = null;
    //         });
            
    //         $("#crop").click(function(){
    //             const canvas = cropper.getCroppedCanvas({
    //                 width: 200,
    //                 height: 200,
    //             });
            
    //             canvas.toBlob(function(blob) {
    //                 url = URL.createObjectURL(blob);
    //                 var reader = new FileReader();
    //                 reader.readAsDataURL(blob); 
    //                 reader.onloadend = function() {
    //                     var base64data = reader.result;	
    //                     sessionStorage.setItem('image', base64data);
    //                     // let img = `
    //                     //     <span id="del-img">X</span>
    //                     //     <img id="original" src="${$session.getItem('image')}" class="z-depth-1-half avatar-pic" alt="" width="500">
    //                     // `
    //                     $('#prof').attr('src', base64data)
    //                     $modal.modal('hide');
    //                 }
    //             });
    //         })
    //     })
    // });
})