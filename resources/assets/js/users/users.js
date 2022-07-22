'use strict';

let tableName = '#usersTbl';
let usersTable = $(tableName).DataTable({
    processing: true,
    serverSide: true,
    'order': [[5, 'desc']],
    ajax: {
        url: usersUrl,
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
        // {
        //     'targets': [4],
        //     'orderable': false,
        //     'className': 'text-center',
        // },
        {
            'targets': [4],
            'orderable': false,
            'className': 'text-center',
            'width': '120px',
        },
        {
            'targets': [5],
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
            name: 'last_name',
        },
        {
            data: function (row) {
                return `${row.name}`;
            },
            name: 'name',
        },
        {
            data: function (row) {
                return row.address ?? 'N/A';
            },
            name: 'address',
        },
        {
            data: function (row) {
                return row.phone ?? 'N/A';
            },
            name: 'phone',
        },
        // {
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
            data: function (row) {
                return `
                <a title="Edit" class="btn btn-warning btn-sm action-btn edit-btn" href="${usersUrl + row.id + '/edit'}">
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
    deleteItem(usersUrl + id, tableName, 'User');
};

$(document).on('click', '.isActive', function () {
    let id = $(this).data('id');
    $.ajax({
        type: 'POST',
        url: route('update.is-active'),
        data: {id: id},
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $(tableName).DataTable().ajax.reload(null, false);
            }
        },
        error: function error(result) {
            console.log(result);
        },
    });
});
