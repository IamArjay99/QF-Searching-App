document.addEventListener("DOMContentLoaded", function () {
    $(".btn-accept").on("click", function () {
        const user_id = $(this).data("user_id");
        const user_role = $(this).data("user_role");
        const id = $(this).data("id");
        const name = $(this).data("name");
        $.ajax({
            type: "POST",
            url: "../ajax/process-messages.php",
            data: { queryAcceptMessage: { id, user_id, user_role } },
            success: function (data) {
                if (data === "success") {
                    window.location.href = "request-messages.php";
                } else {
                    alert("There was an error");
                }
            },
        });
    });
    $(".btn-reject").on("click", function () {
        const user_id = $(this).data("user_id");
        const user_role = $(this).data("user_role");
        const id = $(this).data("id");
        const name = $(this).data("name");
        $.ajax({
            type: "POST",
            url: "../ajax/process-messages.php",
            data: { queryRejectMessage: { id, user_id, user_role } },
            success: function (data) {
                if (data === "success") {
                    window.location.href = "request-messages.php";
                } else {
                    alert("There was an error");
                }
            },
        });
    });
});
