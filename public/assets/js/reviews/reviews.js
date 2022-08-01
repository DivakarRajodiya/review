/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!************************************************!*\
  !*** ./resources/assets/js/reviews/reviews.js ***!
  \************************************************/


var tableName = '#reviewsTbl';
var usersTable = $(tableName).DataTable({
  processing: true,
  serverSide: true,
  'order': [[3, 'desc']],
  ajax: {
    url: reviewsUrl,
    data: function data(_data) {}
  },
  'fnInitComplete': function fnInitComplete() {},
  columnDefs: [{
    'targets': [0],
    'className': 'text-center',
    'width': '65px'
  }, {
    'targets': [2],
    'orderable': false,
    'className': 'text-center',
    'width': '120px'
  }, {
    'targets': [3],
    'visible': false
  }],
  columns: [{
    data: function data(row) {
      return row.rating;
    },
    name: 'rating'
  }, {
    data: function data(row) {
      return row.review_message;
    },
    name: 'review_message'
  }, {
    data: function data(row) {
      return "\n                <a title=\"Delete\" class=\"btn btn-primary action-btn btn-sm notification-btn\" data-id=\"".concat(row.id, "\" onclick=\"sendNotification(").concat(row.id, ")\" href=\"javascript:void(0)\">\n                    <i class=\"fa fa-bell\"></i>\n                </a>\n                <a title=\"Delete\" class=\"btn btn-danger action-btn btn-sm delete-btn\" data-id=\"").concat(row.id, "\" onclick=\"deleteData(").concat(row.id, ")\" href=\"javascript:void(0)\">\n                    <i class=\"fa fa-trash\"></i>\n                </a>");
    },
    name: 'id'
  }, {
    data: 'created_at',
    name: 'created_at'
  }]
});

window.deleteData = function (id) {
  deleteItem(reviewsUrl + id, tableName, 'Review');
};

window.sendNotification = function (id) {
  swal({
    title: 'Notification !',
    html: true,
    text: '<div class="alert alert-warning swal__alert">\n' + '<strong class="swal__text-warning">' + 'Are you sure want to sent message ?' + '</strong></div> <textarea id="title" class="form-control mt-5 w-100" placeholder="Please enter title."></textarea> <textarea id="message" class="form-control mt-3 w-100" placeholder="Please type message."></textarea>',
    showCancelButton: true,
    closeOnConfirm: false,
    showLoaderOnConfirm: true,
    confirmButtonColor: '#6777ef',
    cancelButtonColor: '#d33',
    cancelButtonText: 'No',
    confirmButtonText: 'Yes'
  }, function () {
    var message = $('#message').val();
    var title = $('#title').val();

    if (title == '') {
      swal.showInputError('Please enter title!');
      $('.sa-input-error').removeClass('show');
      return false;
    }

    if (message == '') {
      swal.showInputError('Please enter message!');
      $('.sa-input-error').removeClass('show');
      return false;
    }

    $('.sa-error-container').removeClass('show');
    $('.sa-input-error').removeClass('show');
    $.ajax({
      type: 'post',
      url: reviewsUrl + id + '/send-notification',
      data: {
        id: id,
        message: message,
        title: title
      },
      success: function success(data) {
        if (data.success) {
          swal({
            title: 'Sent!',
            text: 'Notification' + ' has been sent.',
            type: 'success',
            confirmButtonColor: '#6777ef',
            timer: 2000
          });
          $(tableName).DataTable().ajax.reload(null, false);
        }
      },
      error: function error(data) {
        swal({
          title: '',
          text: data.responseJSON.message,
          type: 'error',
          confirmButtonColor: '#00b074',
          timer: 5000
        });
      }
    });
  });
};
/******/ })()
;