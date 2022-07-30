'use strict';

let tableName = '#bannersTbl';
let usersTable = $(tableName).DataTable({
    processing: true,
    serverSide: true,
    'order': [[4, 'desc']],
    ajax: {
        url: bannersUrl,
        data: function (data) {
        },
    },
    'fnInitComplete': function () {
    },
    columnDefs: [
        {
            'targets': [0],
            'orderable': false,
            'className': 'text-center',
            'width': '65px',
        },
        {
            'targets': [1],
            'orderable': true,
            'className': 'text-center',
        },
        {
            'targets': [2],
            'orderable': true,
            'className': 'text-center',
        },
        {
            'targets': [3],
            'orderable': false,
            'className': 'text-center',
        },
        {
            'targets': [4],
            'visible': false,
        },
    ],
    columns: [
        {
            data: function (row) {
                if (row.image_url == null) {
                    return '<img src="' + defaultImage +
                        '" class="thumbnail-rounded img-thumbnail user-img user-profile-img"' +
                        '</img>';
                }
                return '<img src="' + row.image_url +
                    '" class="thumbnail-rounded img-thumbnail user-img user-profile-img"' +
                    '</img>';
            },
            name: 'name',
        },
        {
            data: function (row) {
                return `${row.name}`;
            },
            name: 'name',
        },
        {
            data: function (row) {
                return `${row.link}`;
            },
            name: 'link',
        },
        {
            data: function (row) {
                return `
                <a title="Edit" class="btn btn-warning btn-sm action-btn edit-btn" href="${bannersUrl + row.id + '/edit'}">
                    <i class="fa fa-edit"></i>
                </a>
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
    deleteItem(bannersUrl + id, tableName, 'Banner');
};
