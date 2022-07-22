/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!*************************************************!*\
  !*** ./resources/assets/js/settings/setting.js ***!
  \*************************************************/


$(document).on('change', '#logo', function () {
  var validFile = isValidFile($(this), '#logoValidationError');

  if (validFile) {
    displayPhoto(this, '#logoPreview');
  } else {
    $(this).val('');
  }
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