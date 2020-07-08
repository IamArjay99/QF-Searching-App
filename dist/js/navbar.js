document.addEventListener("DOMContentLoaded", function () {
    $("#nav-open").on("click", () => {
        $("#nav-open").hide();
        $("#nav-close").show();
        $("#nav-close, .menu").addClass("show");
        $("#nav-close, .menu").fadeIn(500);
    });
    $("#nav-close").on("click", () => {
        $("#nav-close").hide();
        $("#nav-open").show();
        $("#nav-close, .menu").removeClass("show");
        $("#nav-close, .menu").fadeOut(500);
    });
});
