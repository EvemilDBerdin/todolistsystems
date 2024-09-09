$(() => {
    tbl_todo();
})

window.editShowModalBtn = function (id) {
    $('#editTodoIdModal input[name="id"]').val(id);
    let data = new FormData();
    data.append('id', id);
    sendAjax(urls + "home/editShowModalBtn", data).then((res) => {
        if (res) {
            $('#editTodoIdModal input[name="edit[title]"]').val(res.title);
            $('#editTodoIdModal input[name="edit[description]"]').val(res.description);
            $('#editTodoIdModal input[name="edit[duedate]"]').val(res.duedate);
        }
    }).then(() => {
        $('#editTodoIdModal').modal('show');
    });
    closeDataTableModal();
};

const tbl_todo = () => {
    $('#tbl_todo').DataTable({
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "responsive": true,
        "destroy": true,
        "order": [
            [0, 'asc']
        ], //Initial no order.
        "columns": [
            {
                "data": "title",
                "width": "15%"
            },
            {
                "data": "description",
                "width": "15%",
                "responsivePriority": 10001
            },
            {
                "data": "duedate",
                "width": "25%"
            },
            {
                "data": "status",
                "width": "15%",
                "render": function (data, type, row, meta) {
                    var color = '';
                    switch (data.toLowerCase()) {
                        case 'completed':
                            color = 'btn-success';
                            break;
                        case 'inprogress':
                            color = 'btn-warning';
                            break;
                        case 'pending':
                            color = 'btn-danger';
                            break;
                        default:
                            color = 'btn-primary'
                    }
                    return `<button class="rounded ${color}")">${data}</button>`;
                }
            },
            {
                "data": "id",
                "width": "30%",
                "render": function (data, type, row, meta) {
                    return `
                    <button class="btn btn-primary" onclick="pendingBtn('${row.id}')">Accept</button>
                    <button class="btn btn-success" onclick="completeBtn('${row.id}')">Completed</button>
                    <button class="btn btn-info" onclick="editShowModalBtn('${row.id}')">Edit</button> 
                    <button class="btn btn-danger" onclick="deleteBtn('${row.id}')">Delete</button>
                    `;
                }
            },
        ],
        "language": {
            "search": '',
            "searchPlaceholder": "Search keyword...",
            "infoFiltered": ""
        },
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": urls + "home/tbl_todo",
            "type": "POST",
        },
        "responsive": {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function (row) {
                        var data = row.data();
                        return 'Details for ' + data.title;
                    }
                }),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table'
                })
            }
        },
        "columnDefs": [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }
        ]
    });
}


function closeDataTableModal() {
    if ($.fn.dataTable.tables) {
        $.fn.dataTable.tables({ visible: true, api: true }).responsive.recalc();
    }
    $('.modal').modal('hide');
    $.fn.dataTable.tables({ visible: true, api: true }).responsive.recalc();
}

const pendingBtn = ($id) => {
    let data = new FormData();
    data.append('id', $id);
    Swal.fire({
        title: 'Are you sure you want to accept todo?',
        type: 'info',
        showCancelButton: true,
        confirmButtonText: 'Yes',
    }).then((res) => {
        if (res.value) {
            $.ajax({
                url: urls + "home/todostatusquery",
                type: "POST",
                dataType: "json",
                data: data,
                async: false,
                processData: false,
                contentType: false,
                cache: false,
                success: function (res) {
                    if (res.type == 'success') {
                        sendAjax(urls + "home/todostatus", data).then((res) => {
                            swalRes(res.response, res.msg);
                            return (res.response == 200) ? true : false;
                        }).then(() => {
                            setTimeout(function () {
                                wLocation();
                            }, 1500);
                        })
                    }
                    else {
                        swalRes(res.response, "cannot accept");
                    }

                },
                error: function (err) {
                    console.log('error');
                },
            });
        }
    })
}

const completeBtn = ($id) => {
    let data = new FormData();
    data.append('id', $id);
    Swal.fire({
        title: 'Are you sure it is completed?',
        type: 'info',
        showCancelButton: true,
        confirmButtonText: 'Yes',
    }).then((res) => {
        if (res.value) {
            $.ajax({
                url: urls + "home/todocompletedquery",
                type: "POST",
                dataType: "json",
                data: data,
                async: false,
                processData: false,
                contentType: false,
                cache: false,
                success: function (res) {
                    if (res.type == 'success') {
                        sendAjax(urls + "home/todocomplete", data).then((res) => {
                            swalRes(res.response, res.msg);
                            return (res.response == 200) ? true : false;
                        }).then(() => {
                            setTimeout(function () {
                                window.location = window.location;
                            }, 1500);
                        })
                    }
                    else {
                        swalRes(res.response, "failed");
                    }
                },
                error: function (err) {
                    console.log(err);
                },
            });
        }
    })
}

const deleteBtn = ($id) => {
    let data = new FormData();
    data.append('id', $id);
    Swal.fire({
        title: 'Are you sure you want to delete todo?',
        type: 'info',
        showCancelButton: true,
        confirmButtonText: 'Yes',
    }).then((res) => {
        if (res.value) {
            sendAjax(urls + "home/deleteBtn", data).then((res) => {
                swalRes(res.response, res.msg);
                return (res.response == 200) ? true : false;
            }).then(() => {
                setTimeout(function () {
                    window.location = window.location;
                }, 1500);
            })
        }
    })
}

const addTodoForm = (e) => {
    e.preventDefault();
    let data = new FormData(e.currentTarget);
    sendAjax(urls + 'home/addTodoForm', data).then((res) => {
        swalRes(res.response, res.msg);
        return (res.response == 200) ? true : false;
    }).then(() => {
        setTimeout(function () {
            wLocation();
        }, 1500);
    })
}

const editTodoForm = (e) => {
    e.preventDefault();
    let data = new FormData(e.currentTarget);
    sendAjax(urls + 'home/editTodoForm', data).then((res) => {
        swalRes(res.response, res.msg);
        return (res.response == 200) ? true : false;
    }).then(() => {
        setTimeout(function () {
            wLocation();
        }, 1500);
    })

}

/* useful function */
function sendAjax(url, data = {}, isForm = false) {
    if (isForm) {
        return new Promise(function (myResolve, myReject) {
            $.ajax({
                url: url,
                type: "POST",
                dataType: "json",
                data: data,
                async: false,
                cache: false,
                enctype: "multipart/form-data",
                processData: false,
                contentType: false,
                beforeSend: function () {
                    // loader(element.target, element.type)
                },
                success: function (res) {
                    myResolve(res); // when successful
                },
                error: function (err) {
                    myReject(err); // when error
                },
            });
        });

    } else {
        return new Promise(function (myResolve, myReject) {
            $.ajax({
                url: url,
                type: "POST",
                dataType: "json",
                data: data,
                async: false,
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function () {
                    // loader(element.target, element.type)
                },
                success: function (res) {
                    myResolve(res); // when successful
                },
                error: function (err) {
                    myReject(err); // when error
                },
            });
        });
    }
}
const swalRes = (status, message) => {
    (status == 200) ? Swal.fire({
        position: 'top-center',
        type: 'success',
        title: message,
        showConfirmButton: false,
        timer: 1500
    }) : Swal.fire({
        position: 'top-center',
        type: 'error',
        title: message,
        showConfirmButton: false,
        timer: 1500
    })
}
const wLocation = () => {
    window.location = window.location;
}