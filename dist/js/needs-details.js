document.addEventListener("DOMContentLoaded", function () {
    $(".close, .cancel").on("click", function () {
        $(".modal").fadeOut();
        $(".modal-content").hide();
    });
    $(document).keyup(function (e) {
        if (e.key === "Escape") {
            // escape key maps to keycode `27`
            $(".modal").fadeOut();
            $(".modal-content").hide();
        }
    });

    // Triggered button add
    $("#btn-add-need").on("click", function () {
        $("#addneedModal").show();
        $("#modal-add-need").slideDown(500);
        $("#btn-save-need").on("click", function (e) {
            e.preventDefault();
            const city_id = $("#add-city-id").val();
            const name = $("#add-need-name").val();
            const stock = $("#add-need-stock").val();
            if (name === "" || stock === "") {
                $("#add-error-message").addClass("alert-danger").show();
                $("#add-error-message").html(
                    "<div class='text-danger text-center'><strong>Error!</strong> All fields are required</div>"
                );
                setTimeout(() => {
                    $("#add-error-message").removeClass("alert-danger").hide();
                }, 3000);
            } else {
                $.ajax({
                    type: "POST",
                    url: "../ajax/process-needs.ajax.php",
                    data: { queryAddNeeds: { city_id, name, stock } },
                    success: function (data) {
                        if (data === "existed") {
                            $("#add-error-message")
                                .addClass("alert-danger")
                                .show();
                            $("#add-error-message").html(
                                "<div class='text-danger text-center'><strong>Error!</strong> Already exists</div>"
                            );
                            setTimeout(() => {
                                $("#add-error-message")
                                    .removeClass("alert-danger")
                                    .hide();
                            }, 3000);
                        } else if (data === "success") {
                            $("#addneedModal").hide();
                            $("#modal-add-need").hide();
                            setTimeout(
                                () => {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Added successfully",
                                        text: "The need was successfully added",
                                        showConfirmButton: false,
                                        timer: 1500,
                                    });
                                },
                                setTimeout(() => {
                                    location.reload();
                                }, 1000)
                            );
                        } else {
                            $("#addneedModal").hide();
                            $("#modal-add-need").hide();
                            Swal.fire({
                                icon: "error",
                                title: "Added failed",
                                text: "There was an error adding the need",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        }
                    },
                });
            }
        });
    });

    // Triggered button edit
    $(".btn-edit-need").on("click", function () {
        $("#editNeedModal").show();
        $("#modal-edit-need").slideDown(500);
        var cur_name = $(this).data("name");
        var cur_stock = $(this).data("stock");
        var need_id = $(this).data("id");
        // alert(cur_name+" "+cur_stock+" "+need_id);
        $("#edit-need-name").val(cur_name);
        $("#edit-need-stock").val(cur_stock);
        $("#btn-edit-save-need").on("click", function (e) {
            e.preventDefault();
            var city_id = $("#edit-city-id").val();
            var name = $("#edit-need-name").val();
            var stock = $("#edit-need-stock").val();
            if (name === "" || stock === "") {
                $("#edit-error-message").addClass("alert-danger").show();
                $("#edit-error-message").html(
                    "<div class='text-danger text-center'><strong>Error!</strong> All fields are required</div>"
                );
                setTimeout(() => {
                    $("#edit-error-message").removeClass("alert-danger").hide();
                }, 3000);
            } else {
                $.ajax({
                    type: "POST",
                    url: "../ajax/process-needs.ajax.php",
                    data: { queryEditNeeds: { need_id, city_id, name, stock } },
                    success: function (data) {
                        if (data === "existed") {
                            $("#edit-error-message")
                                .addClass("alert-danger")
                                .show();
                            $("#edit-error-message").html(
                                "<div class='text-danger text-center'><strong>Error!</strong> Already exists</div>"
                            );
                            setTimeout(() => {
                                $("#edit-error-message")
                                    .removeClass("alert-danger")
                                    .hide();
                            }, 3000);
                        } else if (data === "success") {
                            $("#editNeedModal").hide();
                            $("#modal-edit-need").hide();
                            setTimeout(
                                () => {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Updated successfully",
                                        text:
                                            "The need was successfully updated",
                                        showConfirmButton: false,
                                        timer: 1500,
                                    });
                                },
                                setTimeout(() => {
                                    location.reload();
                                }, 1000)
                            );
                        } else {
                            $("#editNeedModal").hide();
                            $("#modal-edit-need").hide();
                            Swal.fire({
                                icon: "error",
                                title: "Update failed",
                                text: "There was an error updating the need",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        }
                    },
                });
            }
        });
    });

    // Triggered button delete
    $(".btn-delete-need").on("click", function () {
        const needID = $(this).data("id");
        const needTYPE = $(this).data("name");
        Swal.fire({
            title: `Do you want to delete ${needTYPE}?`,
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
                    data: { queryDeleteNeed: needID },
                    success: function (data) {
                        if (data === "success") {
                            setTimeout(
                                () => {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Deleted successfully",
                                        text:
                                            "The need was moved to the archived",
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
