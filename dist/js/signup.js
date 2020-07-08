// INPUT VALIDATION FOR SIGN UP FORM
document.addEventListener("DOMContentLoaded", function () {
    const btnSignup = document.getElementById("btn-signup");
    btnSignup.addEventListener("click", function (e) {
        e.preventDefault();
        const fullname = document.getElementById("inputFullName").value;
        const username = document.getElementById("inputUsername").value;
        const email = document.getElementById("inputEmail").value;
        const password = document.getElementById("inputPassword").value;
        const birthday = document.getElementById("inputBirthday").value;
        if (
            fullname === "" ||
            username === "" ||
            email === "" ||
            password === "" ||
            birthday === ""
        ) {
            $("#error-feedback").addClass("failed").show();
            $("#error-feedback").html("All fields are required");
            setTimeout(() => {
                $("#error-feedback").fadeOut("fast");
                $("#error-feedback").removeClass("failed");
            }, 3000);
        } else {
            $.ajax({
                url: "../ajax/process-signin-signup.ajax.php",
                type: "POST",
                data: {
                    querySignup: {
                        fullname,
                        username,
                        email,
                        password,
                        birthday,
                    },
                },
                success: function (data) {
                    if (data === "existed") {
                        $("#error-feedback").addClass("failed").show();
                        $("#error-feedback").html("User already existed");
                        setTimeout(() => {
                            $("#error-feedback").fadeOut("fast");
                            $("#error-feedback").removeClass("failed");
                        }, 3000);
                    } else if (data === "success") {
                        $("#error-feedback").addClass("success").show();
                        $("#error-feedback").html("User successfully created");
                        setTimeout(() => {
                            document.getElementById("form-signup").reset();
                            $("#error-feedback").fadeOut("fast");
                            $("#error-feedback").removeClass("success");
                        }, 3000);
                    } else {
                        $("#error-feedback")
                            .addClass("alert-danger text-danger")
                            .show();
                        $("#error-feedback").html(
                            "Signup failed, please try again"
                        );
                        setTimeout(() => {
                            $("#error-feedback").fadeOut("fast");
                            $("#error-feedback").removeClass(
                                "alert-danger text-danger"
                            );
                        }, 3000);
                    }
                },
            });
        }
    });
});
