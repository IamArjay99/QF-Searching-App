document.addEventListener("DOMContentLoaded", function () {
    const searchCity = document.getElementById("searchCity");

    // USING AJAX
    function load_data(search) {
        $.ajax({
            url: "../ajax/process-d-city.ajax.php",
            type: "post",
            data: { query: search },
            success: function (data) {
                $("#table").html(data);
            },
            error: function () {
                $("#table").html("There was an error in fetching");
            },
        });
    }

    // DYNAMIC SEARCH
    function showCity(city) {
        searchCity.value = city;
        if (searchCity.value != "") {
            load_data(city);
        } else {
            load_data("*");
        }
    }
    $("#searchCity").keyup(function () {
        const search = $(this).val();
        if (search != "") {
            load_data(search);
        } else {
            load_data("*");
        }
    });
});
