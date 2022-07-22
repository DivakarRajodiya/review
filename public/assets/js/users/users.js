/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!********************************************!*\
  !*** ./resources/assets/js/users/users.js ***!
  \********************************************/


var tableName = '#usersTbl';
var usersTable = $(tableName).DataTable({
  processing: true,
  serverSide: true,
  'order': [[5, 'desc']],
  ajax: {
    url: usersUrl,
    data: function data(_data) {}
  },
  'fnInitComplete': function fnInitComplete() {},
  columnDefs: [{
    'targets': [0],
    'orderable': false,
    'className': 'text-center',
    'width': '65px'
  }, // {
  //     'targets': [4],
  //     'orderable': false,
  //     'className': 'text-center',
  // },
  {
    'targets': [4],
    'orderable': false,
    'className': 'text-center',
    'width': '120px'
  }, {
    'targets': [5],
    'visible': false
  }],
  columns: [{
    data: function data(row) {
      if (row.image_url == null) {
        return '<img src="' + defaultImage + '" class="thumbnail-rounded img-thumbnail user-img user-profile-img"' + '</img>';
      }

      return '<img src="' + row.image_url + '" class="thumbnail-rounded img-thumbnail user-img user-profile-img"' + '</img>';
    },
    name: 'last_name'
  }, {
    data: function data(row) {
      return "".concat(row.name);
    },
    name: 'name'
  }, {
    data: function data(row) {
      var _row$address;

      return (_row$address = row.address) !== null && _row$address !== void 0 ? _row$address : 'N/A';
    },
    name: 'address'
  }, {
    data: function data(row) {
      var _row$phone;

      return (_row$phone = row.phone) !== null && _row$phone !== void 0 ? _row$phone : 'N/A';
    },
    name: 'phone'
  }, // {
  //     data: function (row) {
  //         return `<div class="form-group">
  //               <label class="custom-switch mt-2">
  //                 <input type="checkbox" name="is_active" data-id="${row.id}" ${row.is_active == 1 ? 'checked' : ''} class="custom-switch-input isActive">
  //                 <span class="custom-switch-indicator"></span>
  //               </label>
  //             </div>`;
  //     },
  //     name: 'phone',
  // },
  {
    data: function data(row) {
      return "\n                <a title=\"Edit\" class=\"btn btn-warning btn-sm action-btn edit-btn\" href=\"".concat(usersUrl + row.id + '/edit', "\">\n                    <i class=\"fa fa-edit\"></i>\n                </a>\n                <a title=\"Delete\" class=\"btn btn-danger action-btn btn-sm delete-btn\" data-id=\"").concat(row.id, "\" onclick=\"deleteData(").concat(row.id, ")\" href=\"javascript:void(0)\">\n                    <i class=\"fa fa-trash\"></i>\n                </a>");
    },
    name: 'id'
  }, {
    data: 'created_at',
    name: 'created_at'
  }]
});

window.deleteData = function (id) {
  deleteItem(usersUrl + id, tableName, 'User');
};

$(document).on('click', '.isActive', function () {
  var id = $(this).data('id');
  $.ajax({
    type: 'POST',
    url: route('update.is-active'),
    data: {
      id: id
    },
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $(tableName).DataTable().ajax.reload(null, false);
      }
    },
    error: function error(result) {
      console.log(result);
    }
  });
});
/******/ })()
;