document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.querySelector(".sidebar");
    const topbarMenu = document.querySelector(".topbar-menu");
    const topbarLogout = document.querySelector(".topbar-logout");
    const main = document.querySelector("#content");
    let flag = false;
    topbarMenu.addEventListener("click", function () {
        const width = window.innerWidth;
        flag = !flag;
        if (flag) {
            if (width > 768) {
                sidebar.classList.add("min");
                topbarMenu.style.marginLeft = "70px";
                main.style.paddingLeft = "70px";
            } else {
                sidebar.classList.add("max");
                topbarMenu.style.marginLeft = "250px";
                main.style.paddingLeft = "70px";
            }
            topbarLogout.style.visibility = width < 411 && "hidden";
        } else {
            if (width > 768) {
                sidebar.classList.remove("min");
                topbarMenu.style.marginLeft = "250px";
                main.style.paddingLeft = "250px";
            } else {
                sidebar.classList.remove("max");
                topbarMenu.style.marginLeft = "70px";
                main.style.paddingLeft = "70px";
            }
            topbarLogout.style.visibility = width < 411 && "visible";
        }
    });
});
