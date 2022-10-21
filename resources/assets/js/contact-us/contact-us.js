'use strict';

let tableName = '#contactUsTbl';
let usersTable = $(tableName).DataTable({
    processing: true,
    serverSide: true,
    'order': [[0, 'desc']],
    ajax: {
        url: contactUsUrl,
        data: function (data) {
        },
    },
    'fnInitComplete': function () {
    },
    columnDefs: [
        {
            'targets': [0],
            'orderable': true,
            'className': 'text-center',
        },
        {
            'targets': [1],
            'orderable': true,
            'className': 'text-center',
        },
        {
            'targets': [4],
            'orderable': false,
            'className': 'text-center',
        },
        {
            'targets': [5],
            'visible': false,
        },
    ],
    columns: [
        {
            data: function (row) {
                return `${row.name}`;
            },
            name: 'name',
        },
        {
            data: function (row) {
                return `${row.email}`;
            },
            name: 'email',
        },
        {
            data: function (row) {
                return `${row.subject}`;
            },
            name: 'subject',
        },
        {
            data: function (row) {
                return `${row.message}`;
            },
            name: 'message',
        },
        {
            data: function (row) {
                return `
                <a title="Delete" class="btn btn-danger action-btn btn-sm delete-btn" data-id="${row.id}" onclick="deleteData(${row.id})" href="javascript:void(0)">
                    <i class="fa fa-trash"></i>
                </a>`;
            }, name: 'id',
        },
        {
            data: 'created_at',
            name: 'created_at',
        },
    ],
});
window.deleteData = function (id) {
    deleteItem(contactUsUrl + id, tableName, 'Contact Us');
};
