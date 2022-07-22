/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!************************************************!*\
  !*** ./resources/assets/js/banners/banners.js ***!
  \************************************************/


var tableName = '#bannersTbl';
var usersTable = $(tableName).DataTable({
  processing: true,
  serverSide: true,
  'order': [[2, 'desc']],
  ajax: {
    url: bannersUrl,
    data: function data(_data) {}
  },
  'fnInitComplete': function fnInitComplete() {},
  columnDefs: [{
    'targets': [0],
    'orderable': false,
    'className': 'text-center',
    'width': '65px'
  }, {
    'targets': [1],
    'orderable': false,
    'className': 'text-center'
  }, {
    'targets': [2],
    'visible': false
  }],
  columns: [{
    data: function data(row) {
      if (row.image_url == null) {
        return '<img src="' + defaultImage + '" class="thumbnail-rounded img-thumbnail user-img user-profile-img"' + '</img>';
      }

      return '<img src="' + row.image_url + '" class="thumbnail-rounded img-thumbnail user-img user-profile-img"' + '</img>';
    },
    name: 'name'
  }, {
    data: function data(row) {
      return "".concat(row.name);
    },
    name: 'name'
  }, {
    data: function data(row) {
      return "\n                <a title=\"Edit\" class=\"btn btn-warning btn-sm action-btn edit-btn\" href=\"".concat(bannersUrl + row.id + '/edit', "\">\n                    <i class=\"fa fa-edit\"></i>\n                </a>\n                <a title=\"Delete\" class=\"btn btn-danger action-btn btn-sm delete-btn\" data-id=\"").concat(row.id, "\" onclick=\"deleteData(").concat(row.id, ")\" href=\"javascript:void(0)\">\n                    <i class=\"fa fa-trash\"></i>\n                </a>");
    },
    name: 'id'
  }, {
    data: 'created_at',
    name: 'created_at'
  }]
});

window.deleteData = function (id) {
  deleteItem(bannersUrl + id, tableName, 'Banner');
};
/******/ })()
;