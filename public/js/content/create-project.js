$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
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