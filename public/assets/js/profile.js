/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!****************************************!*\
  !*** ./resources/assets/js/profile.js ***!
  \****************************************/
$(document).on('click', '.edit-profile', function (event) {
  $('#pfUserId').val(loggedInUser.id);
  $('#pfName').val(loggedInUser.name);
  $('#pfEmail').val(loggedInUser.email);
  $('#edit_preview_photo').attr('src', loggedInUser.image_url);
  $('#EditProfileModal').appendTo('body').modal('show');
});
$(document).on('change', '#pfImage', function () {
  var ext = $(this).val().split('.').pop().toLowerCase();

  if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
    $(this).val('');
    $('#editProfileValidationErrorsBox').html('The profile image must be a file of type: jpeg, jpg, png.').show();
  } else {
    displayPhoto(this, '#edit_preview_photo');
  }
});
$(document).on('submit', '#editProfileForm', function (event) {
  event.preventDefault();
  var userId = $('#pfUserId').val();
  var loadingButton = jQuery(this).find('#btnPrEditSave');
  loadingButton.button('loading');
  $.ajax({
    url: "update-profile/" + userId,
    type: 'POST',
    headers: {
      Accept: 'application/json'
    },
    data: new FormData($(this)[0]),
    processData: false,
    contentType: false,
    success: function success(result) {
      if (result.success) {
        $('#EditProfileModal').modal('hide');
        setTimeout(function () {
          location.reload();
        }, 1500);
      }
    },
    error: function error(result) {
      console.log(result);
    },
    complete: function complete() {
      loadingButton.button('reset');
    }
  });
});
$(document).on('submit', '#changePasswordForm', function (event) {
  event.preventDefault();
  var loadingButton = jQuery(this).find('#btnPasswordEditSave');
  loadingButton.button('loading');
  $.ajax({
    url: $(this).attr('action'),
    type: 'post',
    headers: {
      Accept: 'application/json'
    },
    data: new FormData($(this)[0]),
    processData: false,
    contentType: false,
    success: function success(result) {
      $('#changePasswordModal').modal('hide');
      displaySuccessMessage('Password Updated Successfully');
    },
    error: function error(result) {
      $('#editPasswordValidationErrorsBox').html(result.responseJSON.message).show();
      $(document).ready(function () {
        $('.alert').delay(5000).slideUp(300);
      });
    },
    complete: function complete() {
      loadingButton.button('reset');
    }
  });
});
$('#changePasswordModal').on('hidden.bs.modal', function () {
  $('.show-password').addClass('show');
  $(this).find(':text').attr('type', 'password');
  resetModalForm('#changePasswordForm', '#editPasswordValidationErrorsBox');
});
/******/ })()
;