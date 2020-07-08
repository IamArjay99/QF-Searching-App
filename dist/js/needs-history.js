document.addEventListener("DOMContentLoaded", function () {
    // Clear all
    $("#btn-clear-all").on("click", function () {
        const cityID = $(this).data("id");
        Swal.fire({
            title: `Do you want to clear all history log?`,
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
                    data: { queryClearAllHistoryLog: cityID },
                    success: function (data) {
                        if (data === "success") {
                            setTimeout(
                                () => {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Cleared successfully",
                                        text: "The history was cleared",
                                        showConfirmButton: false,
                                        timer: 1500,
                                    });
                                },
                                setTimeout(() => {
                                    location.reload();
                                }, 1500)
                            );
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: "There was an error clearing the history",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        }
                    },
                });
            }
        });
    });
    // Delete specific
    $(".btnDelete").on("click", function () {
        const id = $(this).data("id");
        const name = $(this).data("name");
        Swal.fire({
            title: `Do you want to delete ${name}?`,
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
                    data: { queryDeleteHistoryLog: id },
                    success: function (data) {
                        if (data === "success") {
                            setTimeout(
                                () => {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Deleted successfully",
                                        text:
                                            "The history was deleted successfully",
                                        showConfirmButton: false,
                                        timer: 1500,
                                    });
                                },
                                setTimeout(() => {
                                    location.reload();
                                }, 1500)
                            );
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: "There was an error deleting the history",
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
