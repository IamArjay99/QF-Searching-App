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

    // When the button update was triggered
    $(".updateRoom").on("click", function () {
        var cityID = $(this).data("city_id");
        const roomID = $(this).data("room_id");
        const name = $(this).data("name");
        const no_of_patient = $(this).data("no_of_patient");
        const max_capacity = $(this).data("max_capacity");
        $("#city-id").val(cityID);
        $("#room-id").val(roomID);
        $("#room-name").val(name);
        $("#room-no_of_patient").val(no_of_patient);
        $("#room-max_capacity").val(max_capacity);
        $("#updateRoomModal").show();
        $("#modal-update-room").slideDown(500);
        $("#btn-room-update").on("click", function (e) {
            e.preventDefault();
            const updatedRoomName = $("#room-name").val();
            const updatedRoomMaxCapacity = $("#room-max_capacity").val();
            const queryUpdateRoom = {
                "city-id": cityID,
                "room-id": roomID,
                "room-name": updatedRoomName,
                "room-max_capacity": updatedRoomMaxCapacity,
            };
            $.ajax({
                type: "POST",
                url: "../ajax/process-room.ajax.php",
                data: { queryUpdateRoom },
                success: function (data) {
                    if (data === "success") {
                        $("#updateRoomModal").hide();
                        $("#modal-update-room").hide(500);
                        setTimeout(
                            () => {
                                Swal.fire({
                                    icon: "success",
                                    title: "Updated successfully",
                                    text: "The room was successfully updated",
                                    showConfirmButton: false,
                                    timer: 1500,
                                });
                            },
                            setTimeout(() => {
                                location.reload();
                            }, 1000)
                        );
                    } else if (data === "existed") {
                        $("#update-error-message")
                            .addClass("alert-danger")
                            .show();
                        $("#update-error-message").html(
                            "<div class='text-danger text-center'><strong>Error!</strong> Name already exists</div>"
                        );
                        setTimeout(() => {
                            $("#update-error-message")
                                .removeClass("alert-danger")
                                .hide();
                        }, 3000);
                    } else {
                        $("#updateRoomModal").hide();
                        $("#modal-update-room").hide(500);
                        Swal.fire({
                            icon: "error",
                            title: "Failed to update",
                            text: "There was an error updating the room",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    }
                },
            });
            console.log(updatedRoomName, updatedRoomMaxCapacity);
        });
    });

    // When the button add another room was triggered
    $("#btn-add-room").on("click", function () {
        $("#addRoomModal").show();
        $("#modal-add-room").slideDown(500);
        $("#btn-room-add").on("click", function (e) {
            e.preventDefault();
            var cityID = $("#add-city-id").val();
            const addedRoomName = $("#add-room-name").val();
            const addedRoomNoOfPatient = $("#add-room-no_of_patient").val();
            const addedRoomMaxCapacity = $("#add-room-max_capacity").val();
            if (addedRoomName === "" || addedRoomMaxCapacity === "") {
                $("#add-error-message").addClass("alert-danger").show();
                $("#add-error-message").html(
                    "<div class='text-danger text-center'><strong>Error!</strong> All fields are required</div>"
                );
                setTimeout(() => {
                    $("#add-error-message").removeClass("alert-danger").hide();
                }, 3000);
            } else {
                const queryAddedRoom = {
                    "city-id": cityID,
                    "room-name": addedRoomName,
                    "room-no_of_patient": addedRoomNoOfPatient,
                    "room-max_capacity": addedRoomMaxCapacity,
                };
                $.ajax({
                    type: "POST",
                    url: "../ajax/process-room.ajax.php",
                    data: { queryAddedRoom },
                    success: function (data) {
                        if (data === "success") {
                            $("#addRoomModal").hide();
                            $("#modal-add-room").hide();
                            setTimeout(
                                () => {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Added successfully",
                                        text: "The room was successfully added",
                                        showConfirmButton: false,
                                        timer: 1500,
                                    });
                                },
                                setTimeout(() => {
                                    location.reload();
                                }, 1000)
                            );
                        } else if (data === "existed") {
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
                        } else {
                            $("#addRoomModal").hide();
                            $("#modal-add-room").hide();
                            Swal.fire({
                                icon: "error",
                                title: "Added failed",
                                text: "There was an error adding the room",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        }
                    },
                });
            }
        });
    });

    // Delete room
    $(".deleteRoom").on("click", function () {
        const roomID = $(this).data("id");
        const roomName = $(this).data("name");
        Swal.fire({
            title: `Do you want to delete ${roomName}?`,
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
                    data: { queryDeleteRoom: roomID },
                    success: function (data) {
                        if (data === "success") {
                            setTimeout(
                                () => {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Deleted successfully",
                                        text:
                                            "The room was moved to the archived",
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
