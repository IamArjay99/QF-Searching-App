// After loaded the content, do this
document.addEventListener("DOMContentLoaded", function () {
    // Content for the needs column using AJAX
    const needsContent = (urlCity) => {
        $.ajax({
            url: "../ajax/city.ajax.php",
            type: "post",
            data: { queryNeeds: urlCity },
            beforeSend: function () {
                $("#loadingNeeds").show();
            },
            complete: function () {
                $("#loadingNeeds").hide();
            },
            success: function (data) {
                const needsResult = JSON.parse(data);
                const getRandomColor = () => {
                    var letters = "0123456789ABCDEF";
                    var color = "#";
                    for (var i = 0; i < 6; i++) {
                        color += letters[Math.floor(Math.random() * 16)];
                    }
                    return color;
                };
                var labels = needsResult.map((item) => item.type);
                var dataset_data = needsResult.map((item) =>
                    parseInt(item.stock)
                );
                var backgroundColor = [];
                var borderColor = [];
                for (var i = 0; i < needsResult.length; i++) {
                    backgroundColor.push(getRandomColor());
                    borderColor.push("#000000");
                }
                console.log(backgroundColor);
                var ctx = document
                    .getElementById("myChartNeeds")
                    .getContext("2d");
                var myChartNeeds = new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: "Available Stocks",
                                data: dataset_data,
                                backgroundColor: backgroundColor,
                                borderColor: borderColor,
                                borderWidth: 2,
                            },
                        ],
                    },
                    options: {
                        scales: {
                            yAxes: [
                                {
                                    ticks: {
                                        beginAtZero: true,
                                    },
                                },
                            ],
                        },
                    },
                });
            },
            error: function () {
                $("#needs-content").html("There was an error in fetching");
            },
        });
    };

    // Content for the patient status column using AJAX
    const patientContent = (urlCity) => {
        $.ajax({
            url: "../ajax/city.ajax.php",
            type: "post",
            data: { queryPatients: urlCity },
            beforeSend: function () {
                $("#loadingPatients").show();
            },
            complete: function () {
                $("#loadingPatients").hide();
            },
            success: function (data) {
                const patientsResult = JSON.parse(data);
                var ctx = document
                    .getElementById("myChartPatients")
                    .getContext("2d");
                var patientsPUI = patientsResult.filter(
                    (item) => item.status === "PUI"
                ).length;
                var patientsPUM = patientsResult.filter(
                    (item) => item.status === "PUM"
                ).length;
                var patientsActive = patientsResult.filter(
                    (item) => item.status === "Active"
                ).length;
                var patientsRecovered = patientsResult.filter(
                    (item) => item.status === "Recovered"
                ).length;
                var patientsDied = patientsResult.filter(
                    (item) => item.status === "Died"
                ).length;
                var patientsArr = [
                    patientsPUI,
                    patientsPUM,
                    patientsActive,
                    patientsRecovered,
                    patientsDied,
                ];
                var data = {
                    datasets: [
                        {
                            data: patientsArr,
                            backgroundColor: [
                                "#67e1db",
                                "#dde167",
                                "#0000ff",
                                "#00ff00",
                                "#ff0000",
                            ],
                            hoverBackgroundColor: [
                                "#479b97",
                                "#bbbf59",
                                "#0808c3",
                                "#05b505",
                                "#bc0707",
                            ],
                            hoverBorderColor: "#ebebbf",
                            hoverBorderWidth: 2,
                        },
                    ],
                    borderColor: "#000",
                    labels: ["PUI", "PUM", "Active", "Recovered", "Died"],
                };
                var myPieChart = new Chart(ctx, {
                    type: "pie",
                    data: data,
                    options: {
                        responsive: true,
                        legend: {
                            position: "bottom",
                        },
                        plugins: {
                            datalabels: {
                                color: "#fff",
                                align: "start",
                            },
                        },
                    },
                });
            },
            error: function () {
                $("#patients-content").html("There was an error fetching data");
            },
        });
    };

    var url = window.location.href;
    var start = url.indexOf("=") + 1;
    const urlID = url.substring(start, url.length);
    needsContent(urlID);
    patientContent(urlID);
});
