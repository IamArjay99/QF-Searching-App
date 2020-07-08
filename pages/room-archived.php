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
    <main class="room-details-main" id="content">
        <article>
            <h2 class="text-center pt-5"><?= $cityName ?> Quarantine Facility</h2>
            <h4 class="text-center mb-4">Rooms Archived</h4>
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center table-striped mb-5" id="rooms-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>No. of Patient</th>
                            <th>Max Capacity</th>
                            <th>&nbsp</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            // Fetchting the rooms in the table
                            $getArchivedRooms = $rooms->getAllArchivedRooms($cityID);
                            $count = 1;
                            $rows = count($getArchivedRooms);
                            if ($rows > 0) {
                                foreach($getArchivedRooms as $room) {
                                    $output = "<tr>";
                                    $output .= "<td>".$count."</td>";
                                    $output .= "<td>".$room['name']."</td>";
                                    $getCountPatient = count($patients->getRoomPatientPUI($room['id'], $cityID, "PUI")) + count($patients->getRoomPatientPUM($room['id'], $cityID, "PUM")) + count($patients->getRoomPatientActive($room['id'], $cityID, "Active"));
                                    $output .= "<td>".$getCountPatient."</td>";
                                    $output .= "<td>".$room['max_capacity']."</td>";
                                    $output .= "<td><div class='btn-group'>";
                                    $output .= '<button type="button" class="btn btn-success restoreRoom" title="Restore Room" data-room_id="'.$room["id"].'" data-city_id="'.$cityID.'" data-name="'.$room['name'].'"><i class="fa fa-window-restore" aria-hidden="true"></i></button>';
                                    $output .= '<button class="btn btn-danger permanentDeleteRoom" title="Permanent Delete" data-room_id="'.$room["id"].'" data-city_id="'.$cityID.'" data-name="'.$room['name'].'"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                                    $output .= "</div></td>";
                                    $output .= "</tr>";
                                    echo $output;
                                    $count += 1;
                                }
                            } else {
                                echo "<tr><td colspan='5'>No data found </td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </article>
    </main>
<?php endblock() ?>

<?php startblock('another_js') ?>
    <script src="../dist/js/room-archived.js"></script>
<?php endblock() ?>



