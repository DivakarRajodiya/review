$(document).on('change', '#photo', function () {
    let validFile = isValidFile($(this),
        '#photoValidationErrorsBox');
    if (validFile) {
        displayPhoto(this, '#photoImagePreview');
    } else {
        $(this).val('');
    }
});

$(document).on('submit', '#createForm', function (event) {
    event.preventDefault();
    let loadingButton = $('#btnSave');
    loadingButton.button('loading');
    $('#createForm')[0].submit();
    return true;
});

$(document).on('submit', '#editForm', function (event) {
    event.preventDefault();
    let loadingButton = $('#btnSave');
    loadingButton.button('loading');
    $('#editForm')[0].submit();

    return true;
});
