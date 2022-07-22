'use strict';

$(document).on('change', '#logo', function () {
    let validFile = isValidFile($(this), '#logoValidationError');
    if (validFile) {
        displayPhoto(this, '#logoPreview');
    } else {
        $(this).val('');
    }
});

$(document).on('submit', '#editForm', function (event) {
    event.preventDefault();
    let loadingButton = $('#btnSave');
    loadingButton.button('loading');
    $('#editForm')[0].submit();

    return true;
});
