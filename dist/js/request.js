document.addEventListener("DOMContentLoaded", function () {
    $("#btn-submit").on("click", function (e) {
        e.preventDefault();
        const id = document.getElementById("id").value;
        const address = document.getElementById("address").value;
        const city = document.getElementById("city").value;
        const message = document.getElementById("message").value;
        if (city === "" || address === "" || message === "") {
            const errMsg =
                "<span><strong>Error!</strong> All fields are required</span>";
            $("#error-message").addClass("error").html(errMsg);
            setTimeout(() => {
                $("#error-message").removeClass("error").html("");
            }, 3000);
        } else {
            const data = {
                id,
                address,
                city,
                message,
            };
            $.ajax({
                type: "POST",
                url: "../ajax/process-request.ajax.php",
                data: { queryRequest: data },
                success: function (data) {
                    if (data === "success") {
                        setTimeout(
                            () => {
                                Swal.fire({
                                    icon: "success",
                                    title: "Message sent",
                                    text: "The message was successfully sent",
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
                            text: "There was an error sending your data",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    }
                },
            });
        }
    });

    $(".btn-save").on("click", function (e) {
        e.preventDefault();
        const id = $(this).data("id");
        const room = $("#select-room-" + id).val();
        const status = $("#select-status-" + id).val();
        if (room === null && status === null) {
            $("#select-room-" + id).css("border", "1px solid red");
            $("#select-status-" + id).css("border", "1px solid red");
            setTimeout(() => {
                $("#select-room-" + id).css("border", "none");
                $("#select-status-" + id).css("border", "none");
            }, 3000);
        } else if (room === null) {
            $("#select-room-" + id).css("border", "1px solid red");
            setTimeout(() => {
                $("#select-room-" + id).css("border", "none");
            }, 3000);
        } else if (status === null) {
            $("#select-status-" + id).css("border", "1px solid red");
            setTimeout(() => {
                $("#select-status-" + id).css("border", "none");
            }, 3000);
        } else {
            let queryProcessRequest = { id, room, status };
            $.ajax({
                type: "POST",
                url: "../ajax/process-request.ajax.php",
                data: { queryProcessRequest },
                success: function (data) {
                    if (data === "success") {
                        setTimeout(
                            () => {
                                Swal.fire({
                                    icon: "success",
                                    title: "Request saved",
                                    text: "The request was saved successfully",
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
                            text: "There was an error saving request",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    }
                },
            });
        }
    });
});
