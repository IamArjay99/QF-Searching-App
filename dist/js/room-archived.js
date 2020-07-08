document.addEventListener("DOMContentLoaded", function () {
    $(".restoreRoom").on("click", function () {
        const cityID = $(this).data("city_id");
        const roomID = $(this).data("room_id");
        const name = $(this).data("name");
        Swal.fire({
            title: `Do you want to restore ${name}?`,
            icon: "question",
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonColor: "#2285bd",
            cancelButtonColor: "#C70039",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "../ajax/process-room.ajax.php",
                    data: { queryRestoreRoom: { roomID, cityID } },
                    success: function (data) {
                        if (data === "success") {
                            setTimeout(
                                () => {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Restored successfully",
                                        text:
                                            "The room was successfully restored",
                                        showConfirmButton: false,
                                        timer: 1500,
                                    });
                                },
                                setTimeout(() => {
                                    location.reload();
                                }, 1000)
                            );
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: "There was an error restoring the room",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        }
                    },
                });
            }
        });
    });
    $(".permanentDeleteRoom").on("click", function () {
        const cityID = $(this).data("city_id");
        const roomID = $(this).data("room_id");
        const name = $(this).data("name");
        Swal.fire({
            title: `Do you want to permanently delete ${name}?`,
            icon: "question",
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonColor: "#2285bd",
            cancelButtonColor: "#C70039",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "../ajax/process-room.ajax.php",
                    data: { queryPermanentDeleteRoom: { roomID, cityID } },
                    success: function (data) {
                        if (data === "success") {
                            setTimeout(
                                () => {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Deleted successfully",
                                        text:
                                            "The room was permanently deleted",
                                        showConfirmButton: false,
                                        timer: 1500,
                                    });
                                },
                                setTimeout(() => {
                                    location.reload();
                                }, 1000)
                            );
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: "There was an error deleting the room",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        }
                    },
                });
            }
        });
    });
});
