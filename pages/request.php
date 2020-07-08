<?php 
    include '../layouts/d-layout.php';

    // Getting all cities
    $getAllCities = $cities->getAllCities();
?>

<?php startblock('another_css') ?>
<?php endblock() ?>

<?php startblock('main_content') ?>
    <main class="request-main" id="content">
        <article>
        <?php if ($user_role !== "admin") { ?>
            <div class="request-patient-form">
                <form action="#" method="POST">
                    <div class="error-message" id="error-message"></div>
                    <input type="hidden" name="id" id="id" value="<?= $user_id ?>">
                    <div class="form-group">
                        <label for="#address">Address</label>
                        <input
                            type="text"
                            name="address"
                            id="address"
                            placeholder="Enter your home address"
                            required
                            autocomplete="off"
                            required
                        />
                    </div>
                    <div class="form-group">
                        <label for="#city">City</label>
                        <select name="city" id="city" required>
                            <option value="" disabled selected>Choose City</option>
                            <?php foreach($getAllCities as $city) { ?>
                                <option value="<?= $city['id'] ?>"><?= $city['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="#message">Message</label>
                        <textarea
                            name="message"
                            id="message"
                            placeholder="Specify your reason"
                            required
                        ></textarea>
                    </div>
                    <button type="submit" id="btn-submit">Submit</button>
                </form>
            </div>
        <?php } else { ?>
            <div class="table table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class='text-center'>
                            <th>#</th>
                            <th>Name</th>
                            <th>Message</th>
                            <th>City</th>
                            <th>Room</th>
                            <th>Status</th>
                            <th>&nbsp</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        // Getting all requests
                        $getAllAcceptedRequest = $request->getAllAcceptedRequest();
                        $count = 1;
                        if (count($getAllAcceptedRequest) > 0) {
                            foreach($getAllAcceptedRequest as $acceptedRequest) {
                                $id = $acceptedRequest['patient_id'];
                                $getPatient = $patients->getPatient($id);
                                $name = $getPatient['fullname'];
                                $city_id = $getPatient['city_id'];
                                $getCity = $cities->getCity($city_id);
                                $city = $getCity['name'];
                                $output = "<tr>";
                                $output .= "<td>".$count."</td>";
                                $output .= "<td>".$name."</td>";
                                $getRequest = $request->getRequest($id);
                                $messages = ""; 
                                foreach ($getRequest as $msg) {
                                    $messages .= $msg['message']."<br>";
                                }
                                $output .= "<td>".$messages."</td>";
                                $output .= "<td>".$city."</td>";
                                $output .= "<form method='POST' action='#'>";
                                $output .= "<td>";
                                $output .= "<input type='hidden' name='patient_id' value='".$id."'>";
                                $output .= "<select id='select-room-".$id."' name='select-room' class='form-control select-room' required>";
                                $output .= "<option value='' disabled selected>Select Room</option>";
                                $getAllRooms = $rooms->getAllRooms($city_id);
                                foreach ($getAllRooms as $room) {
                                    $output .= "<option value='".$room['id']."'>".$room['name']."</option>";
                                }
                                $output .= "</select>";
                                $output .= "</td>";
                                $output .= "<td>";
                                $output .= "<select id='select-status-".$id."' name='select-status' class='form-control select-status' required>";
                                $output .= "<option value='' disabled selected>Select Status</option>";
                                $output .= "<option value='PUI'>PUI</option>";
                                $output .= "<option value='PUM'>PUM</option>";
                                $output .= "<option value='Active'>Active</option>";
                                $output .= "<option value='Recovered'>Recovered</option>";
                                $output .= "<option value='Died'>Died</option>";
                                $output .= "</td>";
                                $output .= "<td><button type='submit' class='btn btn-primary btn-save' data-id='".$id."'>Save</button></td>";
                                $output .= "</form>";
                                $output .= "</tr>";
                                $count += 1;
                                echo $output;
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center'>No data found</td></tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
        </article> 
    </main>
<?php endblock() ?>

<?php startblock('another_js') ?>
    <script src="../dist/js/request.js"></script>
<?php endblock() ?>



