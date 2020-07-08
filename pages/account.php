<?php 
    include '../layouts/d-layout.php';
?>

<?php startblock('another_css') ?>
<?php endblock() ?>

<?php startblock('main_content') ?>
    <main class="account-main" id="content">
        <article>
            <div class="account-patient-table">
                <table>
                    <tr>
                        <th>Full Name</th>
                        <td><?= $user_fullname ?></td>
                        <td>
                            <button id='btn-update-fullname'>
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td><?= $user_username ?></td>
                        <td>
                            <button id="btn-update-username">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <th>Email Address</th>
                        <td><?= $user_email ?></td>
                        <td>
                            <button id="btn-update-email">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <th>Password</th>
                        <td>**********</td>
                        <td>
                            <button id="btn-update-password">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                    <?php if ($user_role !== "admin") { ?>
                    <tr>
                        <th>Birthday</th>
                        <td><?= date("M d, Y", strtotime($user_birthday)) ?></td>
                        <td>
                            <button id="btn-update-birthday">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <th>Home Address</th>
                        <td><?= $user_address !== NULL ? $user_address : "-" ?></td>
                        <td>
                            <button id="btn-update-address">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <th>Contact Number</th>
                        <td><?= $user_contact_no !== NULL ? $user_contact_no : "-" ?></td>
                        <td>
                            <button id="btn-update-contact-no">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
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
                    <input type="hidden" name="user_id" id="user_id" value="<?= $data['id'] ?>">
                    <input type="hidden" name="user_role" id="user_role" value="<?= $data['role'] ?>">
                    <div class="form-group">
                        <label for="fullname">Full Name</label>
                        <input class="form-control" type="text" id="fullname" name="fullname" value="<?= $user_fullname ?>">
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
                    <input type="hidden" name="user_id" id="user_id" value="<?= $data['id'] ?>">
                    <input type="hidden" name="user_role" id="user_role" value="<?= $data['role'] ?>">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input class="form-control" type="text" id="username" name="username" value="<?= $user_username ?>">
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
                    <input type="hidden" name="user_id" id="user_id" value="<?= $data['id'] ?>">
                    <input type="hidden" name="user_role" id="user_role" value="<?= $data['role'] ?>">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input class="form-control" type="text" id="email" name="email" value="<?= $user_email ?>">
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
                    <input type="hidden" name="user_id" id="user_id" value="<?= $data['id'] ?>">
                    <input type="hidden" name="user_role" id="user_role" value="<?= $data['role'] ?>">
                    <input type="hidden" name="user_password" id="user_password" value="<?= $user_password ?>">
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
                    <input type="hidden" name="user_id" id="user_id" value="<?= $data['id'] ?>">
                    <input type="hidden" name="user_role" id="user_role" value="<?= $data['role'] ?>">
                    <div class="form-group">
                        <label for="birthday">Birthday</label>
                        <input class="form-control" type="date" id="birthday" name="birthday" value="<?= $user_birthday ?>">
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
                    <input type="hidden" name="user_id" id="user_id" value="<?= $data['id'] ?>">
                    <input type="hidden" name="user_role" id="user_role" value="<?= $data['role'] ?>">
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input class="form-control" type="text" id="address" name="address" value="<?= $user_address ?>">
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
                    <input type="hidden" name="user_id" id="user_id" value="<?= $data['id'] ?>">
                    <input type="hidden" name="user_role" id="user_role" value="<?= $data['role'] ?>">
                    <div class="form-group">
                        <label for="contact_no">Contact Number</label>
                        <input class="form-control" type="number" id="contact_no" name="contact_no" value="<?= $user_contact_no ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancel" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="save" id="btn-save-contact_no">Save Changes</button>
                </div>
            </div>
        </form>
    </div>

<?php endblock() ?>

<?php startblock('another_js') ?>
    <script src="../dist/js/account.js"></script>
<?php endblock() ?>



