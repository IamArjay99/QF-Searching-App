<?php 
    include '../layouts/d-layout.php';

    if ($user_role !== "admin") {
        echo "<script>window.history.back();</script>";
    }

    if (isset($_GET['patient_id'])) {
        $patient_id = $_GET['patient_id'];
        $getAccount = $account->getAccount($patient_id, "patient");
        $patient_fullname = $getAccount['fullname'];
        $patient_username = $getAccount['username'];
        $patient_email = $getAccount['email'];
        $patient_role = $getAccount['role'];
        $patient_password = $getAccount['password'];
        $patient_birthday = $getAccount['birthday'];
        $patient_age = $getAccount['age'];
        $patient_address = $getAccount['address'];
        $patient_contact_no = $getAccount['contact_no'];
        $patient_status = $getAccount['status'];
        $patient_city_id = $getAccount['city_id'];
        $getCity = $cities->getCity($patient_city_id);
        $city = $getCity['name'];
        $user_room_id = $getAccount['room_id'];
        $getRoom = $rooms->getRoom($patient_city_id, $user_room_id);
        $room = $getRoom['name'];
    } else {
        echo "<script>window.history.back();</script>";
    }
    
?>

<?php startblock('another_css') ?>
<?php endblock() ?>

<?php startblock('main_content') ?>
    <main class="patient-main" id="content">
        <article>
            <div class="container">
                <h2 class="text-center pt-5">Patient</h2>
                <div class="row mt-4 mb-5">
                    <div class="col-md-6 col">
                        <table class='table table-bordered'>
                            <tr>
                                <th class="label">Full Name</th>
                                <td><?= $patient_fullname ?> <button class='btn btn-info btn-sm float-right' id='btn-update-fullname'><i class="fa fa-pencil-square" aria-hidden="true"></i></button></td>
                            </tr>
                            <tr>
                                <th class="label">Username</th>
                                <td><?= $patient_username ?> <button class='btn btn-info btn-sm float-right' id='btn-update-username'><i class="fa fa-pencil-square" aria-hidden="true"></i></button></td>
                            </tr>
                            <tr>
                                <th class="label">Email Address</th>
                                <td><?= $patient_email ?> <button class='btn btn-info btn-sm float-right' id='btn-update-email'><i class="fa fa-pencil-square" aria-hidden="true"></i></button></td>
                            </tr>
                            <tr>
                                <th class="label">Password</th>
                                <td>********** <button class='btn btn-info btn-sm float-right' id='btn-update-password'><i class="fa fa-pencil-square" aria-hidden="true"></i></button></td>
                            </tr>
                            <tr>
                                <th class="label">Birthday</th>
                                <td><?= date("M d, Y", strtotime($patient_birthday)) ?> <button class='btn btn-info btn-sm float-right' id='btn-update-birthday'><i class="fa fa-pencil-square" aria-hidden="true"></i></button></td>
                            </tr>
                            <tr>
                                <th class="label">Address</th>
                                <td><?= $patient_address ?> <button class='btn btn-info btn-sm float-right' id='btn-update-address'><i class="fa fa-pencil-square" aria-hidden="true"></i></button></td>
                            </tr>
                            <tr>
                                <th class="label">Contact Number</th>
                                <td><?= $patient_contact_no ?> <button class='btn btn-info btn-sm float-right' id='btn-update-contact-no'><i class="fa fa-pencil-square" aria-hidden="true"></i></button></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6 col">
                        <table class='table table-bordered'>
                            <tr>
                                <th>City</th>
                                <th><?= $city ?> <button class='btn btn-info btn-sm float-right' id='btn-update-city'><i class="fa fa-pencil-square" aria-hidden="true"></i></button></th>
                            </tr>
                            <tr>
                                <th>Room</th>
                                <th><?= $room ?> <button class='btn btn-info btn-sm float-right' id='btn-update-room'><i class="fa fa-pencil-square" aria-hidden="true"></i></button></th>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <th><?= $patient_status ?> <button class='btn btn-info btn-sm float-right' id='btn-update-status'><i class="fa fa-pencil-square" aria-hidden="true"></i></button></th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </article>
    </main>

    <!-- Update Fullname modal -->
    <div class="modal" id="updateFullNameModal">
        <form method="POST">
            <div class="modal-content" id="modal-fullname">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateFullNameModalLabel">Update Full Name</h5>
                    <button type="button" class="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="update-fullname-error-msg py-2 mb-3" id="update-fullname-error-msg"></div>
                    <input type="hidden" name="user_id" id="user_id" value="<?= $patient_id ?>">
                    <input type="hidden" name="user_role" id="user_role" value="<?= $patient_role ?>">
                    <div class="form-group">
                        <label for="fullname">Full Name</label>
                        <input class="form-control" type="text" id="fullname" name="fullname" value="<?= $patient_fullname ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancel" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="save" id="btn-save-fullname">Save Changes</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Update Username Modal -->
    <div class="modal" id="updateUsernameModal">
        <form method="POST">
            <div class="modal-content" id="modal-username">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateUsernameModalLabel">Update Username</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="update-username-error-msg py-2 mb-3" id="update-username-error-msg" style="display: none"></div>
                    <input type="hidden" name="user_id" id="user_id" value="<?= $patient_id ?>">
                    <input type="hidden" name="user_role" id="user_role" value="<?= $patient_role ?>">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input class="form-control" type="text" id="username" name="username" value="<?= $patient_username ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancel" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="save" id="btn-save-username">Save Changes</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Update Email Modal -->
    <div class="modal" id="updateEmailModal">
        <form method="POST">
            <div class="modal-content" id="modal-email">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateEmailModalLabel">Update Email Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="update-email-error-msg py-2 mb-3" id="update-email-error-msg" style="display: none"></div>
                    <input type="hidden" name="user_id" id="user_id" value="<?= $patient_id ?>">
                    <input type="hidden" name="user_role" id="user_role" value="<?= $patient_role ?>">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input class="form-control" type="text" id="email" name="email" value="<?= $patient_email ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancel" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="save" id="btn-save-email">Save Changes</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Update Password Modal -->
    <div class="modal" id="updatePasswordModal">
        <form method="POST">
            <div class="modal-content" id="modal-password">
                <div class="modal-header">
                    <h5 class="modal-title" id="updatePasswordModalLabel">Update Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="update-password-error-msg py-2 mb-3" id="update-password-error-msg"></div>
                    <input type="hidden" name="user_id" id="user_id" value="<?= $patient_id ?>">
                    <input type="hidden" name="user_role" id="user_role" value="<?= $patient_role ?>">
                    <input type="hidden" name="user_password" id="user_password" value="<?= $patient_password ?>">
                    <div class="form-group">
                        <label for="password">Enter Old Password</label>
                        <input class="form-control" type="password" id="old_password" name="old_password">
                    </div>
                    <div class="form-group">
                        <label for="password">Enter New Password</label>
                        <input class="form-control" type="password" id="new_password" name="new_password">
                    </div>
                    <div class="form-group">
                        <label for="password">Confirm Password</label>
                        <input class="form-control" type="password" id="confirm_password" name="confirm_password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancel" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="save" id="btn-save-password">Save Changes</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Update Birthday Modal -->
    <div class="modal" id="updateBirthdayModal">
        <form method="POST">
            <div class="modal-content" id="modal-birthday">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateBirthdayModalLabel">Update Birthday</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="update-birthday-error-msg py-2 mb-3" id="update-birthday-error-msg" style="display: none"></div>
                    <input type="hidden" name="user_id" id="user_id" value="<?= $patient_id ?>">
                    <input type="hidden" name="user_role" id="user_role" value="<?= $patient_role ?>">
                    <div class="form-group">
                        <label for="birthday">Birthday</label>
                        <input class="form-control" type="date" id="birthday" name="birthday" value="<?= $patient_birthday ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancel" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="save" id="btn-save-birthday">Save Changes</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Update Address Modal -->
    <div class="modal" id="updateAddressModal">
        <form method="POST">
            <div class="modal-content" id="modal-address">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateAddressModalLabel">Update Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="update-address-error-msg py-2 mb-3" id="update-address-error-msg" style="display: none"></div>
                    <input type="hidden" name="user_id" id="user_id" value="<?= $patient_id ?>">
                    <input type="hidden" name="user_role" id="user_role" value="<?= $patient_role ?>">
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input class="form-control" type="text" id="address" name="address" value="<?= $patient_address ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancel" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="save" id="btn-save-address">Save Changes</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Update Contact Modal -->
    <div class="modal fade" id="updateContactNoModal">
        <form method="POST">
            <div class="modal-content" id="modal-contact-no">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateContactNoModalLabel">Update Contact Number</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="update-contact_no-error-msg py-2 mb-3" id="update-contact_no-error-msg" style="display: none"></div>
                    <input type="hidden" name="user_id" id="user_id" value="<?= $patient_id ?>">
                    <input type="hidden" name="user_role" id="user_role" value="<?= $patient_role ?>">
                    <div class="form-group">
                        <label for="contact_no">Contact Number</label>
                        <input class="form-control" type="number" id="contact_no" name="contact_no" value="<?= $patient_contact_no ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancel" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="save" id="btn-save-contact_no">Save Changes</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Update City Modal -->
    <div class="modal fade" id="updateCityModal">
        <form method="POST">
            <div class="modal-content" id="modal-city">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateCityModalLabel">Update City</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="update-city-error-msg py-2 mb-3" id="update-city-error-msg" style="display: none"></div>
                    <input type="hidden" name="user_id" id="user_id" value="<?= $patient_id ?>">
                    <input type="hidden" name="user_role" id="user_role" value="<?= $patient_role ?>">
                    <div class="form-group">
                        <label for="city">City</label>
                        <select name="city" id="city" class="form-control">
                            <option value="<?= $user_city_id ?>" selected default><?= $city ?></option>
                            <?php
                                $getAllCities = $cities->getAllCities();
                                foreach($getAllCities as $item) {
                                    if ($item['id'] !== $user_city_id) {
                            ?>
                            <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                            <?php } } ?>
                        </select>
                    </div>
                    <div class="form-group" id="dom-city-room">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancel" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="save" id="btn-save-city">Save Changes</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Update Room Modal -->
    <div class="modal fade" id="updateRoomModal">
        <form method="POST">
            <div class="modal-content" id="modal-room">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateRoomModalLabel">Update Room</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="update-room-error-msg py-2 mb-3" id="update-room-error-msg" style="display: none"></div>
                    <input type="hidden" name="user_id" id="user_id" value="<?= $patient_id ?>">
                    <input type="hidden" name="user_role" id="user_role" value="<?= $patient_role ?>">
                    <div class="form-group">
                        <label for="room">Contact Number</label>
                        <select name="room" id="room" class="form-control">
                            <option value="<?= $user_room_id ?>" selected><?= $room ?></option>
                            <?php
                                $getAllRooms = $rooms->getAllRooms($patient_city_id);
                                foreach($getAllRooms as $item) {
                                    if ($item['id'] !== $user_room_id) {
                            ?> 
                                <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                            <?php } } ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancel" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="save" id="btn-save-room">Save Changes</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Update Status Modal -->
    <div class="modal fade" id="updateStatusModal">
        <form method="POST">
            <div class="modal-content" id="modal-status">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateStatusModalLabel">Update Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="update-status-error-msg py-2 mb-3" id="update-status-error-msg" style="display: none"></div>
                    <input type="hidden" name="user_id" id="user_id" value="<?= $patient_id ?>">
                    <input type="hidden" name="user_role" id="user_role" value="<?= $patient_role ?>">
                    <div class="form-group">
                        <label for="status">Contact Number</label>
                        <select name="status" id="status" class="form-control">
                            <option value="<?= $patient_status ?>" selected><?= $patient_status ?></option>
                            <?php
                                $getAllStatus = $status->getAllStatus();
                                foreach($getAllStatus as $stat) {
                                    if ($stat['name'] !== $patient_status) {
                            ?>
                            <option value="<?= $stat['name'] ?>"><?= $stat['name'] ?></option>
                            <?php } } ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancel" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="save" id="btn-save-status">Save Changes</button>
                </div>
            </div>
        </form>
    </div>

<?php endblock() ?>

<?php startblock('another_js') ?>
    <script src="../dist/js/account.js"></script>
<?php endblock() ?>

