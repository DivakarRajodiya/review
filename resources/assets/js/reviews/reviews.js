'use strict';

let tableName = '#reviewsTbl';
let usersTable = $(tableName).DataTable({
    processing: true,
    serverSide: true,
    'order': [[3, 'desc']],
    ajax: {
        url: reviewsUrl,
        data: function (data) {
        },
    },
    'fnInitComplete': function () {
    },
    columnDefs: [
        {
            'targets': [0],
            'className': 'text-center',
            'width': '65px',
        },
        {
            'targets': [2],
            'orderable': false,
            'className': 'text-center',
            'width': '120px',
        },
        {
            'targets': [3],
            'visible': false,
        },
    ],
    columns: [
        {
            data: function (row) {
                return row.rating;
            },
            name: 'rating',
        },
        {
            data: function (row) {
                return row.review_message;
            },
            name: 'review_message',
        },
        {
            data: function (row) {
                return `
                <a title="Delete" class="btn btn-primary action-btn btn-sm notification-btn" data-id="${row.id}" onclick="sendNotification(${row.id})" href="javascript:void(0)">
                    <i class="fa fa-bell"></i>
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
    deleteItem(reviewsUrl + id, tableName, 'Review');
};

window.sendNotification = function (id) {
    swal({
            title: 'Notification !',
            html: true,
            text: '<div class="alert alert-warning swal__alert">\n' +
                '<strong class="swal__text-warning">' +
                'Are you sure want to sent message ?' +
                '</strong></div> <textarea id="title" class="form-control mt-5 w-100" placeholder="Please enter title."></textarea> <textarea id="message" class="form-control mt-3 w-100" placeholder="Please type message."></textarea>',
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            confirmButtonColor: '#6777ef',
            cancelButtonColor: '#d33',
            cancelButtonText: 'No',
            confirmButtonText: 'Yes',
        },
        function () {
            let message = $('#message').val();
            let title = $('#title').val();
            if (title == '') {
                swal.showInputError(
                    'Please enter title!');
                $('.sa-input-error').removeClass('show');
                return false;
            }
            if (message == '') {
                swal.showInputError(
                    'Please enter message!');
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
                    title: title,
                },
                success: function (data) {
                    if (data.success) {
                        swal({
                            title: 'Sent!',
                            text: 'Notification' + ' has been sent.',
                            type: 'success',
                            confirmButtonColor: '#6777ef',
                            timer: 2000,
                        });
                        $(tableName).DataTable().ajax.reload(null, false);
                    }
                },
                error: function (data) {
                    swal({
                        title: '',
                        text: data.responseJSON.message,
                        type: 'error',
                        confirmButtonColor: '#00b074',
                        timer: 5000,
                    });
                },
            });
        });
};
