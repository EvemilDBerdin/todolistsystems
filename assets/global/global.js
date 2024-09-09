$(() => {
    // updateOverdueTasks();
})

const asidemylogout = () => {
    Swal.fire({
        title: 'Do you want to logout?',
        showCancelButton: true,
        confirmButtonText: 'logout',
    }).then((res) => {
        if (res.value) {
            Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'You are logging out',
                showConfirmButton: false,
                timer: 1500
            })
                .then(() => {
                    window.location.href = urls + "Home/logout";
                })
        }
    })
}

// function updateOverdueTasks() {
//     // Get the current date
//     let currentDate = new Date().toISOString().slice(0, 10);

//     // Fetch the overdue tasks from the database
//     $.ajax({
//         url: urls + "home/getOverdueTasks",
//         type: "POST",
//         data: { currentDate: currentDate },
//         success: function (response) {
//             let id = JSON.parse(response);
//             if (isNotNullOrUndefined(id) && isNotNullOrUndefined(id.id)) {
//                 console.log(id);
//                 console.log(id.id);
//                 console.log(Object.keys(id.id).length);
//                 console.log('----')
//                 for (let i = 0; i < Object.keys(id.id).length; i++) {
//                     // updateTaskStatus(id.id, "incomplete");
//                 }
//             } else {
//                 console.log('there is no due date task');
//             } 
//         },
//         error: function () {
//             console.error("Error fetching overdue tasks");
//         }
//     });
// }

// function updateTaskStatus(taskId, newStatus) {
//     $.ajax({
//         url: urls + "home/updateTaskStatus",
//         type: "POST",
//         data: { id: taskId, status: newStatus },
//         success: function (response) {
//             console.log('Todo due date status updated successfully');
//         },
//         error: function () {
//             console.error("Error updating task status");
//         }
//     });
// }

// function isNotNullOrUndefined(value) {
//     return value !== null && value !== undefined;
// }



