/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************************!*\
  !*** ./resources/assets/js/users/create_edit.js ***!
  \**************************************************/
$(document).on('change', '#photo', function () {
  var validFile = isValidFile($(this), '#photoValidationErrorsBox');

  if (validFile) {
    displayPhoto(this, '#photoImagePreview');
  } else {
    $(this).val('');
  }
});
$(document).on('submit', '#createForm', function (event) {
  event.preventDefault();
  var loadingButton = $('#btnSave');
  loadingButton.button('loading');
  $('#createForm')[0].submit();
  return true;
});
$(document).on('submit', '#editForm', function (event) {
  event.preventDefault();
  var loadingButton = $('#btnSave');
  loadingButton.button('loading');
  $('#editForm')[0].submit();
  return true;
});
/******/ })()
;