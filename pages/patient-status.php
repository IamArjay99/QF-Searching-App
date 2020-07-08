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
    <main class="patient-status-main" id="content">
        <article>
            <?php
                // Checking if the id of the city is set
                if (isset($_GET['id']) && isset($_SESSION['data'])) {
                    $cityID = $_GET['id'];
                    $city = $cities->getCity($cityID);
                    $cityName = $city['name'];
                    if (!strpos($cityName, 'City')) {
                        $cityName .= " City";
                    }
                    $getCityPatientPUI = $patients->getCityPatientPUI($cityID, "PUI");
                    $getCityPatientPUM = $patients->getCityPatientPUM($cityID, "PUM");
                    $getCityPatientActive = $patients->getCityPatientActive($cityID, "Active");
                    $getCityPatientRecovered = $patients->getCityPatientRecovered($cityID, "Recovered");
                    $getCityPatientDied = $patients->getCityPatientDied($cityID, "Died");
                    $getCityTotalPatient = $patients->getCityTotalPatient($cityID);
                } else {
                    echo "<script>window.history.back();</script>";
                }
            ?>
            <h2><?= $cityName ?> Quarantine Facility</h2>
            <h4>Patient Status</h4>
            <div class="row">
                <div class="offset-md-2 col-md-8 col-sm-12">
                    <div class="table table-responsive">
                        <table class="table table-bordered text-center table-striped">
                            <thead>
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
                                    <td><?= count($getCityPatientPUI) ?></td>
                                    <td><?= count($getCityPatientPUM) ?></td>
                                    <td><?= count($getCityPatientActive) ?></td>
                                    <td><?= count($getCityPatientRecovered) ?></td>
                                    <td><?= count($getCityPatientDied) ?></td>
                                    <td><?= count($getCityTotalPatient) ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php if ($_SESSION['data']['role'] === "admin") { ?>
                <div class="offset-md-1 col-md-10">
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
                                if (count($getCityTotalPatient) > 0) {
                                    foreach($getCityTotalPatient as $patient) {
                                        $output = "";
                                        if ($patient['status'] === "Died") {
                                            $output .= "<tr style='background: red'>";
                                            $output .= "<td>".$count."<small>x</small></td>";
                                        } else if ($patient['status'] === "Recovered") {
                                            $output .= "<tr style='background: green'>";
                                            $output .= "<td>".$count."<small>x</small></td>";
                                        } else if ($patient['status'] === "Active") {
                                            $output .= "<tr style='background: blue'>";
                                            $output .= "<td>".$count."</td>";
                                        } else if ($patient['status'] === "PUI") {
                                            $output .= "<tr style='background: #67e1db'>";
                                            $output .= "<td>".$count."</td>";
                                        } else {
                                            $output .= "<tr style='background: #dde167'>";
                                            $output .= "<td>".$count."</td>";
                                        }
                                        $output .= "<td><a href='patient.php?patient_id=".$patient['id']."' class='text-white'>".$patient['fullname']."</a></td>";
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
                </div>
                <?php } else { ?>
                    <ul class="p-3 my-4 text-justify">
                        <li><strong>Patient Under Investigation (PUI)</strong> - refers to a person who had been in close contact with a person with confirmed infection or/and may have been to place where there is an outbreak.</li>
                        <li><strong>Patient Under Monitoring (PUM)</strong> - is not showing any coronavirus symptoms but has a travel history to areas with issued travel restriction or a history of exposure to the novel virus.</li>
                        <li><strong>Active Cases</strong> - currently infected of the coronovirus.</li>
                        <li><strong>Recovered</strong> - patients who have recovered and overcome the disease.</li>
                        <li><strong>Deaths</strong> - patients who passed away during the fight against covid19.</li>
                        <li><strong>Total Cases</strong> - All patients including PUI and PUM</li>
                    </ul>
                <?php } ?>
            </div>
        </article>
    </main>
<?php endblock() ?>

<?php startblock('another_js') ?>
    <!-- Dynamic Search -->
    <script src="../dist/js/dashboard.js"></script>
<?php endblock() ?>


