document.addEventListener("DOMContentLoaded", function () {
    const btnUpdateFullname = document.querySelector("#btn-update-fullname");
    const btnUpdateUsername = document.querySelector("#btn-update-username");
    const btnUpdateEmail = document.querySelector("#btn-update-email");
    const btnUpdatePassword = document.querySelector("#btn-update-password");
    const btnUpdateBirthday = document.querySelector("#btn-update-birthday");
    const btnUpdateAddress = document.querySelector("#btn-update-address");
    const btnUpdateContactNo = document.querySelector("#btn-update-contact-no");
    const btnUpdateCity = document.querySelector("#btn-update-city");
    const btnUpdateRoom = document.querySelector("#btn-update-room");
    const btnUpdateStatus = document.querySelector("#btn-update-status");

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

    btnUpdateFullname.addEventListener("click", function () {
        $("#updateFullNameModal").show();
        $("#modal-fullname").slideDown(500);
        $("#btn-save-fullname").click(function (e) {
            e.preventDefault();
            const id = $("#user_id").val();
            const role = $("#user_role").val();
            const fullname = $("#fullname").val();
            if (fullname !== "") {
                $.ajax({
                    type: "POST",
                    url: "../ajax/process-account.ajax.php",
                    data: { queryUpdateFullname: { id, fullname, role } },
                    success: function (data) {
                        if (data === "success") {
                            $(".modal").fadeOut();
                            $(".modal-content").hide();
                            setTimeout(
                                () => {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Updated successfully",
                                        text:
                                            "The fullname was successfully updated",
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
                                text: "There was an error updating fullname",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        }
                    },
                });
            } else {
                $("#update-fullname-error-msg").addClass("alert-danger").show();
                $("#update-fullname-error-msg").html(
                    "<div class='text-danger text-center'><strong>Error!</strong> All fields are required</div>"
                );
                setTimeout(() => {
                    $("#update-fullname-error-msg")
                        .removeClass("alert-danger")
                        .hide();
                }, 3000);
            }
        });
    });
    btnUpdateUsername.addEventListener("click", function () {
        $("#updateUsernameModal").show();
        $("#modal-username").slideDown(500);
        $("#btn-save-username").click(function (e) {
            e.preventDefault();
            const id = $("#user_id").val();
            const role = $("#user_role").val();
            const username = $("#username").val();
            if (username !== "") {
                $.ajax({
                    type: "POST",
                    url: "../ajax/process-account.ajax.php",
                    data: { queryUpdateUsername: { id, username, role } },
                    success: function (data) {
                        if (data === "success") {
                            $(".modal").fadeOut();
                            setTimeout(
                                () => {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Updated successfully",
                                        text:
                                            "The username was successfully updated",
                                        showConfirmButton: false,
                                        timer: 1500,
                                    });
                                },
                                setTimeout(() => {
                                    location.reload();
                                }, 1000)
                            );
                        } else if (data === "existed") {
                            $("#update-username-error-msg")
                                .addClass("alert-danger")
                                .show();
                            $("#update-username-error-msg").html(
                                "<div class='text-danger text-center'><strong>Error!</strong> Already exists</div>"
                            );
                            setTimeout(() => {
                                $("#update-username-error-msg")
                                    .removeClass("alert-danger")
                                    .hide();
                            }, 3000);
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: "There was an error updating username",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        }
                    },
                });
            } else {
                $("#update-username-error-msg").addClass("alert-danger").show();
                $("#update-username-error-msg").html(
                    "<div class='text-danger text-center'><strong>Error!</strong> All fields are required</div>"
                );
                setTimeout(() => {
                    $("#update-username-error-msg")
                        .removeClass("alert-danger")
                        .hide();
                }, 3000);
            }
        });
    });
    btnUpdateEmail.addEventListener("click", function () {
        $("#updateEmailModal").show();
        $("#modal-email").slideDown(500);
        $("#btn-save-email").click(function (e) {
            e.preventDefault();
            const id = $("#user_id").val();
            const role = $("#user_role").val();
            const email = $("#email").val();
            if (email !== "") {
                $.ajax({
                    type: "POST",
                    url: "../ajax/process-account.ajax.php",
                    data: { queryUpdateEmail: { id, email, role } },
                    success: function (data) {
                        if (data === "success") {
                            $(".modal").fadeOut();
                            setTimeout(
                                () => {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Updated successfully",
                                        text:
                                            "The email was successfully updated",
                                        showConfirmButton: false,
                                        timer: 1500,
                                    });
                                },
                                setTimeout(() => {
                                    location.reload();
                                }, 1000)
                            );
                        } else if (data === "existed") {
                            $("#update-email-error-msg")
                                .addClass("alert-danger")
                                .show();
                            $("#update-email-error-msg").html(
                                "<div class='text-danger text-center'><strong>Error!</strong> Already exists</div>"
                            );
                            setTimeout(() => {
                                $("#update-email-error-msg")
                                    .removeClass("alert-danger")
                                    .hide();
                            }, 3000);
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: "There was an error updating email",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        }
                    },
                });
            } else {
                $("#update-email-error-msg").addClass("alert-danger").show();
                $("#update-email-error-msg").html(
                    "<div class='text-danger text-center'><strong>Error!</strong> All fields are required</div>"
                );
                setTimeout(() => {
                    $("#update-email-error-msg")
                        .removeClass("alert-danger")
                        .hide();
                }, 3000);
            }
        });
    });
    btnUpdatePassword.addEventListener("click", function () {
        $("#updatePasswordModal").show();
        $("#modal-password").slideDown(500);
        $("#btn-save-password").click(function (e) {
            e.preventDefault();
            const id = $("#user_id").val();
            const role = $("#user_role").val();
            const user_password = $("#user_password").val();
            const old_password = $("#old_password").val();
            const new_password = $("#new_password").val();
            const confirm_password = $("#confirm_password").val();
            if (
                old_password === "" ||
                new_password === "" ||
                confirm_password === ""
            ) {
                $("#update-password-error-msg").addClass("alert-danger").show();
                $("#update-password-error-msg").html(
                    "<div class='text-danger text-center'><strong>Error!</strong> All fields are required</div>"
                );
                setTimeout(() => {
                    $("#update-password-error-msg")
                        .removeClass("alert-danger")
                        .hide();
                }, 3000);
            } else {
                $.ajax({
                    type: "POST",
                    url: "../ajax/process-account.ajax.php",
                    data: {
                        queryUpdatePassword: {
                            id,
                            role,
                            user_password,
                            old_password,
                            new_password,
                            confirm_password,
                        },
                    },
                    success: function (data) {
                        if (data === "incorrect_old_password") {
                            $("#update-password-error-msg")
                                .addClass("alert-danger")
                                .show();
                            $("#update-password-error-msg").html(
                                "<div class='text-danger text-center'><strong>Error!</strong> Wrong old password</div>"
                            );
                            setTimeout(() => {
                                $("#update-password-error-msg")
                                    .removeClass("alert-danger")
                                    .hide();
                            }, 3000);
                        } else if (data === "incorrect_confirm_password") {
                            $("#update-password-error-msg")
                                .addClass("alert-danger")
                                .show();
                            $("#update-password-error-msg").html(
                                "<div class='text-danger text-center'><strong>Error!</strong> Please check your confirm password</div>"
                            );
                            setTimeout(() => {
                                $("#update-password-error-msg")
                                    .removeClass("alert-danger")
                                    .hide();
                            }, 3000);
                        } else if (data === "success") {
                            $(".modal").fadeOut();
                            setTimeout(
                                () => {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Updated successfully",
                                        text:
                                            "The passowrd was successfully updated",
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
                                text: "There was an error updating password",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        }
                    },
                });
            }
        });
    });
    btnUpdateBirthday.addEventListener("click", function () {
        $("#updateBirthdayModal").show();
        $("#modal-birthday").slideDown(500);
        $("#btn-save-birthday").click(function (e) {
            e.preventDefault();
            const id = $("#user_id").val();
            const role = $("#user_role").val();
            const birthday = $("#birthday").val();
            if (birthday === "") {
                $("#update-birthday-error-msg").addClass("alert-danger").show();
                $("#update-birthday-error-msg").html(
                    "<div class='text-danger text-center'><strong>Error!</strong> All fields are required</div>"
                );
                setTimeout(() => {
                    $("#update-birthday-error-msg")
                        .removeClass("alert-danger")
                        .hide();
                }, 3000);
            } else {
                $.ajax({
                    type: "POST",
                    url: "../ajax/process-account.ajax.php",
                    data: { queryUpdateBirthday: { id, role, birthday } },
                    success: function (data) {
                        if (data === "success") {
                            $("#updateBirthdayModal").fadeOut();
                            setTimeout(
                                () => {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Updated successfully",
                                        text:
                                            "The birthday was successfully updated",
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
                                text: "There was an error updating birthday",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        }
                    },
                });
            }
        });
    });
    btnUpdateAddress.addEventListener("click", function () {
        $("#updateAddressModal").show();
        $("#modal-address").slideDown(500);
        $("#btn-save-address").click(function (e) {
            e.preventDefault();
            const id = $("#user_id").val();
            const role = $("#user_role").val();
            const address = $("#address").val();
            if (address === "") {
                $("#update-address-error-msg").addClass("alert-danger").show();
                $("#update-address-error-msg").html(
                    "<div class='text-danger text-center'><strong>Error!</strong> All fields are required</div>"
                );
                setTimeout(() => {
                    $("#update-address-error-msg")
                        .removeClass("alert-danger")
                        .hide();
                }, 3000);
            } else {
                $.ajax({
                    type: "POST",
                    url: "../ajax/process-account.ajax.php",
                    data: { queryUpdateAddress: { id, role, address } },
                    success: function (data) {
                        if (data === "success") {
                            $(".modal").fadeOut();
                            setTimeout(
                                () => {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Updated successfully",
                                        text:
                                            "The address was successfully updated",
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
                                text: "There was an error updating address",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        }
                    },
                });
            }
        });
    });
    btnUpdateContactNo.addEventListener("click", function () {
        $("#updateContactNoModal").show();
        $("#modal-contact-no").slideDown(500);
        $("#btn-save-contact_no").click(function (e) {
            e.preventDefault();
            const id = $("#user_id").val();
            const role = $("#user_role").val();
            const contact_no = $("#contact_no").val();
            if (contact_no === "") {
                $("#update-contact_no-error-msg")
                    .addClass("alert-danger")
                    .show();
                $("#update-contact_no-error-msg").html(
                    "<div class='text-danger text-center'><strong>Error!</strong> All fields are required</div>"
                );
                setTimeout(() => {
                    $("#update-contact_no-error-msg")
                        .removeClass("alert-danger")
                        .hide();
                }, 3000);
            } else {
                $.ajax({
                    type: "POST",
                    url: "../ajax/process-account.ajax.php",
                    data: { queryUpdateContactNo: { id, role, contact_no } },
                    success: function (data) {
                        if (data === "success") {
                            $("#updateContactNoModal").fadeOut();
                            setTimeout(
                                () => {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Updated successfully",
                                        text:
                                            "The contact number was successfully updated",
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
                                text:
                                    "There was an error updating contact number",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        }
                    },
                });
            }
        });
    });
    // Modal city
    btnUpdateCity.addEventListener("click", function () {
        $("#updateCityModal").show();
        $("#modal-city").slideDown(500);
        $("#city").change(function () {
            const city = $("#city").val();
            $.ajax({
                type: "POST",
                url: "../ajax/process-account.ajax.php",
                data: { queryUpdateCityRoom: { city } },
                success: function (data) {
                    $("#dom-city-room").html(data);
                },
            });
        });
        $("#btn-save-city").click(function (e) {
            e.preventDefault();
            const id = $("#user_id").val();
            const role = $("#user_role").val();
            const city = $("#city").val();
            const city_room = $("#city_room").val();
            // alert(city+city_room);
            if (
                city === "" ||
                city_room === "" ||
                city_room === undefined ||
                city_room === null
            ) {
                $("#update-city-error-msg").addClass("alert-danger").show();
                $("#update-city-error-msg").html(
                    "<div class='text-danger text-center'><strong>Error!</strong> All fields are required</div>"
                );
                setTimeout(() => {
                    $("#update-city-error-msg")
                        .removeClass("alert-danger")
                        .hide();
                }, 3000);
            } else {
                $.ajax({
                    type: "POST",
                    url: "../ajax/process-account.ajax.php",
                    data: { queryUpdateCity: { id, role, city, city_room } },
                    success: function (data) {
                        if (data === "success") {
                            $("#updateCityModal").hide();
                            $("#modal-city").hide();
                            setTimeout(
                                () => {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Updated successfully",
                                        text:
                                            "The city was successfully updated",
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
                                text: "There was an error updating city",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        }
                    },
                });
            }
        });
    });
    // Modal room
    btnUpdateRoom.addEventListener("click", function () {
        $("#updateRoomModal").show();
        $("#modal-room").slideDown(500);
        $("#btn-save-room").click(function (e) {
            e.preventDefault();
            const id = $("#user_id").val();
            const role = $("#user_role").val();
            const room = $("#room").val();
            if (room !== "") {
                $.ajax({
                    type: "POST",
                    url: "../ajax/process-account.ajax.php",
                    data: { queryUpdateRoom: { id, room, role } },
                    success: function (data) {
                        if (data === "success") {
                            $("#updateRoomModal").hide();
                            $("#modal-room").hide();
                            setTimeout(
                                () => {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Updated successfully",
                                        text:
                                            "The room was successfully updated",
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
                                text: "There was an error updating room",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        }
                    },
                });
            } else {
                $("#update-room-error-msg").addClass("alert-danger").show();
                $("#update-room-error-msg").html(
                    "<div class='text-danger text-center'><strong>Error!</strong> All fields are required</div>"
                );
                setTimeout(() => {
                    $("#update-room-error-msg")
                        .removeClass("alert-danger")
                        .hide();
                }, 3000);
            }
        });
    });
    // Modal status
    btnUpdateStatus.addEventListener("click", function () {
        $("#updateStatusModal").show();
        $("#modal-status").slideDown(500);
        $("#btn-save-status").click(function (e) {
            e.preventDefault();
            const id = $("#user_id").val();
            const role = $("#user_role").val();
            const status = $("#status").val();
            $.ajax({
                type: "POST",
                url: "../ajax/process-account.ajax.php",
                data: { queryUpdateStatus: { id, status, role } },
                success: function (data) {
                    if (data === "success") {
                        $("#updateStatusModal").hide();
                        $("#modal-status").hide();
                        setTimeout(
                            () => {
                                Swal.fire({
                                    icon: "success",
                                    title: "Updated successfully",
                                    text: "The status was successfully updated",
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
                            text: "There was an error updating status",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    }
                },
            });
        });
    });
});
