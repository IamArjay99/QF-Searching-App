// INPUT VALIDATION FOR SIGN IN FORM
document.addEventListener("DOMContentLoaded", function () {
    const btnSignIn = document.getElementById("btn-signin");
    btnSignIn.addEventListener("click", function (e) {
        e.preventDefault();
        const email = document.getElementById("inputEmail").value;
        const password = document.getElementById("inputPassword").value;
        if (email === "" && password === "") {
            $("#error-feedback").addClass("alert-danger").show();
            $("#error-feedback").html("Email and password are required");
            setTimeout(() => {
                $("#error-feedback").fadeOut("fast");
                $("#error-feedback").removeClass("alert-danger");
            }, 3000);
        } else {
            $.ajax({
                url: "../ajax/process-signin-signup.ajax.php",
                type: "POST",
                data: { querySignin: { email, password } },
                success: function (data) {
                    if (data === "false") {
                        $("#error-feedback").addClass("alert-danger").show();
                        $("#error-feedback").html(
                            "Incorrect Email or Password"
                        );
                        $("#inputPassword").val("");
                        setTimeout(() => {
                            $("#error-feedback").fadeOut("fast");
                            $("#error-feedback").removeClass("alert-danger");
                        }, 3000);
                    } else {
                        // let html =
                        //     "<div class='loading w-100 text-center mb-5'>";
                        // html +=
                        //     "<img src='../img/loader.gif' class='mx-auto w-25'>";
                        // html += "</div>";
                        // $("#error-feedback").show();
                        // $("#error-feedback").html(html);
                        setTimeout(() => {
                            $("#error-feedback").fadeOut("fast");
                            $("#signin-form").submit();
                        }, 3000);
                    }
                },
            });
        }
    });
});
