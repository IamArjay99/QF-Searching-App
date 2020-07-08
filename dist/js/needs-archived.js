document.addEventListener("DOMContentLoaded", function () {
    $(".restoreNeed").on("click", function () {
        const cityID = $(this).data("city_id");
        const id = $(this).data("id");
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
                    url: "../ajax/process-needs.ajax.php",
                    data: { queryRestoreNeed: { id, cityID } },
                    success: function (data) {
                        if (data === "success") {
                            setTimeout(
                                () => {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Restored successfully",
                                        text:
                                            "The need was successfully restored",
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
                                text: "There was an error restoring the need",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        }
                    },
                });
            }
        });
    });
    $(".permanentDeleteNeed").on("click", function () {
        const cityID = $(this).data("city_id");
        const id = $(this).data("id");
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
                    url: "../ajax/process-needs.ajax.php",
                    data: { queryPermanentDeleteNeed: { id, cityID } },
                    success: function (data) {
                        if (data === "success") {
                            setTimeout(
                                () => {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Deleted successfully",
                                        text:
                                            "The need was permanently deleted",
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
                                text: "There was an error deleting the need",
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
