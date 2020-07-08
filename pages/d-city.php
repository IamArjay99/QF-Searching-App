<?php 
    include '../layouts/d-layout.php';

    // Checking if the id of the city is set
    if (isset($_GET['id'])) {
        $cityID = $_GET['id'];
        $city = $cities->getCity($cityID);
        $cityName = $city['name'];
        if (!strpos($cityName, 'City')) {
            $cityName .= " City";
        }
    } else {
        echo "<script>window.history.back();</script>";
    }
?>

<?php startblock('another_css') ?>
<?php endblock() ?>

<?php startblock('main_content') ?>
    <main class="d-city-main" id="content">
        <article>
            <h2 class="page-title"><?= $cityName ?> Quarantine Facility</h2>
            <div class="city-content">
                <div class="city-row">
                    <div class="city-col">
                        <div class="city-col-header">
                            Cases
                        </div>
                        <div class="city-col-body" id="patients-content">
                        <div id="loadingPatients">
                            <img src="../dist/img/loader.gif" class="w-25 rounded-circle" alt="">
                        </div>
                        <!-- See the assets/js/city.js for the code for this canvas -->
                        <canvas id="myChartPatients"></canvas>
                        </div>
                        <div class="city-col-header">
                            <a href="patient-status.php?id=<?= $cityID ?>">Learn More</a>
                        </div>
                    </div>
                    <div class="city-col">
                        <div class="city-col-header">
                            Rooms
                        </div>
                        <div class="city-col-body">
                            <table>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>No. of Patients</th>
                                        <th>Max Capacity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        // Fetchting the rooms in the table
                                        $getRooms = $rooms->getAllRooms($cityID);
                                        $count = 1;
                                        $rows = count($getRooms);
                                        if ($rows > 0) {
                                            foreach($getRooms as $room) {
                                                $output = "<tr>";
                                                $output .= "<td>".$count."</td>";
                                                $getCountPatient = count($patients->getRoomPatientPUI($room['id'], $cityID, "PUI")) + count($patients->getRoomPatientPUM($room['id'], $cityID, "PUM")) + count($patients->getRoomPatientActive($room['id'], $cityID, "Active"));
                                                $output .= "<td>".$room['name']."</td>";
                                                $output .= "<td>".$getCountPatient."</td>";
                                                $output .= "<td>".$room['max_capacity']."</td>";
                                                $output .= "</tr>";
                                                echo $output;
                                                $count += 1;
                                            }
                                        } else {
                                            echo "<tr><td colspan='4'>No data found </td></tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="city-col-header">
                            <a href="room-details.php?id=<?= $cityID ?>">Learn More</a>
                        </div>
                    </div>
                    <div class="city-col">
                        <div class="city-col-header">
                            Needs
                        </div>
                        <div class="city-col-body" id="needs-content">
                            <div id="loadingNeeds">
                                <img src="../dist/img/loader.gif" class="w-25 rounded-circle" alt="">
                            </div>
                            <!-- See the dist/js/city.js for the code for this canvas -->
                            <canvas id="myChartNeeds"></canvas>
                        </div>
                        <div class="city-col-header">
                            <a href="needs-details.php?id=<?= $cityID ?>">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </main>
<?php endblock() ?>

<?php startblock('another_js') ?>
    <!-- Here's a src containing the chart.js file -->
    <script src="../dist/js/city.js"></script>
<?php endblock() ?>


