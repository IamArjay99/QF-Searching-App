<?php 
    include '../layouts/d-layout.php';

    // Checking if the id of the city is set
    if (isset($_GET['id']) && isset($_GET['room_id']) && isset($_SESSION['data'])) {
        $cityID = $_GET['id'];
        $roomID = $_GET['room_id'];
        $city = $cities->getCity($cityID);
        $cityName = $city['name'];
        if (!strpos($cityName, 'City')) {
            $cityName .= " City";
        }
        $room = $rooms->getRoom($cityID, $roomID);
        $roomName = $room['name'];
        $roomMaxCapacity = $room['max_capacity'];
        $getRoomPatientPUI = $patients->getRoomPatientPUI($roomID, $cityID, "PUI");
        $getRoomPatientPUM = $patients->getRoomPatientPUM($roomID, $cityID, "PUM");
        $getRoomPatientActive = $patients->getRoomPatientActive($roomID, $cityID, "Active");
        $getRoomPatientRecovered = $patients->getRoomPatientRecovered($roomID, $cityID, "Recovered");
        $getRoomPatientDied = $patients->getRoomPatientDied($roomID, $cityID, "Died");
        $getRoomPatientTotal = $patients->getRoomPatientTotal($roomID, $cityID);
        $getCountPatient = count($patients->getRoomPatientPUI($roomID, $cityID, "PUI")) + count($patients->getRoomPatientPUM($roomID, $cityID, "PUM")) + count($patients->getRoomPatientActive($roomID, $cityID, "Active"));
    } else {
        echo "<script>window.history.back();</script>";
    }
?>

<?php startblock('another_css') ?>
<?php endblock() ?>

<?php startblock('main_content') ?>
    <main class="room-main" id="content">
        <article>
            <h2 class="text-center pt-5"><?= $cityName ?> Quarantine Facility</h2>
            <h4 class="text-center mb-4">Room - <?= $roomName ?></h4>
            <div class="row">
                <div class="table table-responsive">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th class="text-left">Number of Patient</th>
                            <td class="text-center"><?= $getCountPatient ?></td>
                        </tr>
                        <tr>
                            <th class="text-left">Max Capacity</th>
                            <td class="text-center"><?= $roomMaxCapacity ?></td>
                        </tr>
                    </table>
                </div>
                <div class="table table-responsive">
                    <table class="table table-bordered text-center table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>PUI</th>
                                <th>PUM</th>
                                <th>Active Cases</th>
                                <th>Recovered</th>
                                <th>Deaths</th>
                                <th>Total Cases</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= count($getRoomPatientPUI) ?></td>
                                <td><?= count($getRoomPatientPUM) ?></td>
                                <td class="text-primary"><?= count($getRoomPatientActive) ?></td>
                                <td class="text-success"><?= count($getRoomPatientRecovered) ?></td>
                                <td class="text-danger"><?= count($getRoomPatientDied) ?></td>
                                <td><?= count($getRoomPatientTotal) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <?php if ($user_role === "admin") { ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center my-4 mb-5">
                        <thead class="thead-dark">
                            <tr>
                                <th colspan="5">Patients</th>
                            </tr>
                            <tr>
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Age</th>
                                <th>Address</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $count = 1;
                            if (count($getRoomPatientTotal) > 0) {
                                foreach($getRoomPatientTotal as $patient) {
                                    $output = "";
                                    if ($patient['status'] === "Died") {
                                        $output .= "<tr style='background: #ff0000'>";
                                        $output .= "<td>".$count."<small>x</small></td>";
                                    } else if ($patient['status'] === "Recovered") {
                                        $output .= "<tr style='background: #00ff00'>";
                                        $output .= "<td>".$count."<small>x</small></td>";
                                    } else if ($patient['status'] === "Active") {
                                        $output .= "<tr style='background: #0000ff'>";
                                        $output .= "<td>".$count."</td>";
                                    } else if ($patient['status'] === "PUI") {
                                        $output .= "<tr style='background: #67e1db'>";
                                        $output .= "<td>".$count."</td>";
                                    } else {
                                        $output .= "<tr style='background: #dde167'>";
                                        $output .= "<td>".$count."</td>";
                                    }
                                    $output .= "<td><a href='patient.php?patient_id=".$patient['id']."' style='color: black'>".$patient['fullname']."</a></td>";
                                    $output .= "<td>".$patient['age']."</td>";
                                    $output .= "<td>".$patient['address']."</td>";
                                    $output .= "<td>".$patient['status']."</td>";
                                    $output .= "</tr>";
                                    echo $output;
                                    $count += 1;
                                }
                            } else {
                                echo "<tr><td colspan='5'>No data found</td></tr>";
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
                <?php } ?>
            </div>
        </article> 
    </main>
<?php endblock() ?>

<?php startblock('another_js') ?>
<?php endblock() ?>



