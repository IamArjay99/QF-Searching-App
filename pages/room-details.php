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
            <h4 class="text-center mb-4">Rooms</h4>
            <div class="row">
            <?php if ($user_role === "admin") { ?>
                <div class="float-right mb-2">
                    <a href="room-archived.php?id=<?= $cityID ?>" class="btn btn-info"><i class="fa fa-folder" aria-hidden="true"></i> View Archived</a>
                    <button class="btn btn-primary" id="btn-add-room">Add Another Room</button>
                </div>
            <?php } ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center table-striped mb-5" id="rooms-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>No. of Patient</th>
                                <th>Max Capacity</th>
                                <?php if ($user_role === "admin") { ?>
                                    <th>&nbsp</th>
                                <?php } ?>
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
                                        $output .= "<td><a href='room.php?id=".$cityID."&room_id=".$room['id']."'>".$room['name']."</a></td>";
                                        $getCountPatient = count($patients->getRoomPatientPUI($room['id'], $cityID, "PUI")) + count($patients->getRoomPatientPUM($room['id'], $cityID, "PUM")) + count($patients->getRoomPatientActive($room['id'], $cityID, "Active"));
                                        $output .= "<td>".$getCountPatient."</td>";
                                        $output .= "<td>".$room['max_capacity']."</td>";
                                        if ($user_role === "admin") { 
                                            $output .= "<td>";
                                            $output .= '<button type="button" class="btn btn-success updateRoom" title="Update Room" data-room_id="'.$room["id"].'" data-city_id="'.$cityID.'" data-name="'.$room['name'].'" data-no_of_patient="'.$getCountPatient.'" data-max_capacity="'.$room['max_capacity'].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>';
                                            $output .= '<button class="btn btn-danger deleteRoom" data-id="'.$room["id"].'" data-name="'.$room['name'].'" title="Delete Room"><i class="fa fa-eraser" aria-hidden="true"></i></button>';
                                            $output .= "</td>";
                                        }
                                        $output .= "</tr>";
                                        echo $output;
                                        $count += 1;
                                    }
                                } else {
                                    if ($user_role === "admin") {
                                        echo "<tr><td colspan='5'>No data found </td></tr>";
                                    } else {
                                        echo "<tr><td colspan='4'>No data found </td></tr>";
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </article>
    </main>

    <!-- Add Room Modal -->
    <div class="modal fade" id="addRoomModal">
        <form method="POST">
            <div class="modal-content" id="modal-add-room">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRoomModalLabel">Add Room</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="add-error-message py-2 mb-3" id="add-error-message" style="display: none"></div>
                    <input type="hidden" name="city-id" id="add-city-id" value="<?= $cityID ?>">
                    <div class="form-group">
                        <label for="room-name">Name</label>
                        <input class="form-control" type="text" id="add-room-name" name="add-room-name" required>
                    </div>
                    <div class="form-group">
                        <label for="room-max_capacity">Max Capacity</label>
                        <input class="form-control" type="text" id="add-room-max_capacity" name="add-room-max_capacity" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancel" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="save" id="btn-room-add">Save Room</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Update Room Modal -->
    <div class="modal fade" id="updateRoomModal">
        <form method="POST">
            <div class="modal-content" id="modal-update-room">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateRoomModalLabel">Update Room</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="add-error-message py-2 mb-3" id="update-error-message" style="display: none"></div>
                    <input type="hidden" name="city-id" id="city-id">
                    <input type="hidden" name="room-id" id="room-id">
                    <div class="form-group">
                        <label for="room-name">Name</label>
                        <input class="form-control" type="text" id="room-name" name="room-name">
                    </div>
                    <div class="form-group">
                        <label for="room-no_of_patient">Number of Patient</label>
                        <input class="form-control" type="text" id="room-no_of_patient" name="room-no_of_patient" readonly>
                    </div>
                    <div class="form-group">
                        <label for="room-max_capacity">Max Capacity</label>
                        <input class="form-control" type="text" id="room-max_capacity" name="room-max_capacity">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancel" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="save" id="btn-room-update">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
<?php endblock() ?>

<?php startblock('another_js') ?>
    <script src="../dist/js/room-details.js"></script>
<?php endblock() ?>



