/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!******************************************************!*\
  !*** ./resources/assets/js/contact-us/contact-us.js ***!
  \******************************************************/


var tableName = '#contactUsTbl';
var usersTable = $(tableName).DataTable({
  processing: true,
  serverSide: true,
  'order': [[0, 'desc']],
  ajax: {
    url: contactUsUrl,
    data: function data(_data) {}
  },
  'fnInitComplete': function fnInitComplete() {},
  columnDefs: [{
    'targets': [0],
    'orderable': true,
    'className': 'text-center'
  }, {
    'targets': [1],
    'orderable': true,
    'className': 'text-center'
  }, {
    'targets': [4],
    'visible': false
  }],
  columns: [{
    data: function data(row) {
      return "".concat(row.name);
    },
    name: 'name'
  }, {
    data: function data(row) {
      return "".concat(row.email);
    },
    name: 'email'
  }, {
    data: function data(row) {
      return "".concat(row.subject);
    },
    name: 'subject'
  }, {
    data: function data(row) {
      return "".concat(row.message);
    },
    name: 'message'
  }, // {
  //     data: function (row) {
  //         return `
  //         <a title="Delete" class="btn btn-danger action-btn btn-sm delete-btn" data-id="${row.id}" onclick="deleteData(${row.id})" href="javascript:void(0)">
  //             <i class="fa fa-trash"></i>
  //         </a>`;
  //     }, name: 'id',
  // },
  {
    data: 'created_at',
    name: 'created_at'
  }]
});

window.deleteData = function (id) {
  deleteItem(contactUsUrl + id, tableName, 'Contact Us');
};
/******/ })()
;