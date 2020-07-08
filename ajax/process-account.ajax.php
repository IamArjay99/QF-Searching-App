<?php

    // This will include all the classes
    include_once '../includes/all.include.php';

    // Update city room
    if (isset($_POST['queryUpdateCityRoom'])) {
        $city = $_POST['queryUpdateCityRoom']['city'];
        $getAllRooms = $rooms->getAllRooms($city);
        $output = "<label for='city_room'>Room</label>";
        $output .= "<select name='city_room' id='city_room' class='form-control'>";
        if ($getAllRooms) {
            foreach($getAllRooms as $room) {
                $output .= "<option value='".$room['id']."'>".$room['name']."</option>";
            }
        } else {
            $output .= "<option value='' selected disabled>No rooms found</option>";
        }
        $output .= "</select>";
        echo $output;
    }

    // Update city room 2
    if (isset($_POST['queryUpdateCity'])) {
        $id = $_POST['queryUpdateCity']['id'];
        $role = $_POST['queryUpdateCity']['role'];
        $city = $_POST['queryUpdateCity']['city'];
        $room = $_POST['queryUpdateCity']['city_room'];
        $updatePatientCityRoom = $account->updatePatientCityRoom($id, $role, $city, $room);
        if ($updatePatientCityRoom) {
            echo "success";
        } else {
            echo "failed";
        }
    }

    // Update room
    if (isset($_POST['queryUpdateRoom'])) {
        $id = $_POST['queryUpdateRoom']['id'];
        $role = $_POST['queryUpdateRoom']['role'];
        $room = $_POST['queryUpdateRoom']['room'];
        $updatePatientRoom = $account->updatePatientRoom($id, $role, $room);
        if ($updatePatientRoom) {
            echo "success";
        } else {
            echo "failed";
        }
    }

    // Update status
    if (isset($_POST['queryUpdateStatus'])) {
        $id = $_POST['queryUpdateStatus']['id'];
        $role = $_POST['queryUpdateStatus']['role'];
        $status = $_POST['queryUpdateStatus']['status'];
        $updatePatientStatus = $account->updatePatientStatus($id, $role, $status);
        if ($updatePatientStatus) {
            echo "success";
        } else {
            echo "failed";
        }
    }

    // Update fullname
    if (isset($_POST['queryUpdateFullname'])) {
        $id = $_POST['queryUpdateFullname']['id'];
        $role = $_POST['queryUpdateFullname']['role'];
        $fullname = $_POST['queryUpdateFullname']['fullname'];
        $updateFullname = $account->updateFullname($id, $fullname, $role);
        if ($updateFullname) {
            echo "success";
        } else {
            echo "failed";
        }
    }

    // Update username
    if (isset($_POST['queryUpdateUsername'])) {
        $id = $_POST['queryUpdateUsername']['id'];
        $role = $_POST['queryUpdateUsername']['role'];
        $username = $_POST['queryUpdateUsername']['username'];
        $checkUsername = $account->checkUsername($id, $username, $role);
        if ($checkUsername->rowCount() > 0) {
            echo "failed";
        } else {
            $updateUsername = $account->updateUsername($id, $username, $role);
            if ($updateUsername) {
                echo "success";
            } else {
                echo "failed";
            }
        }
    }

    // Update email
    if (isset($_POST['queryUpdateEmail'])) {
        $id = $_POST['queryUpdateEmail']['id'];
        $role = $_POST['queryUpdateEmail']['role'];
        $email = $_POST['queryUpdateEmail']['email'];
        $checkEmail = $account->checkEmail($id, $email, $role);
        if ($checkEmail->rowCount() > 0) {
            echo "existed";
        } else {
            $updateEmail = $account->updateEmail($id, $email, $role);
            if ($updateEmail) {
                echo "success";
            } else {
                echo "failed";
            }
        }
    }

    // Update birthday
    if (isset($_POST['queryUpdateBirthday'])) {
        $id = $_POST['queryUpdateBirthday']['id'];
        $role = $_POST['queryUpdateBirthday']['role'];
        $birthday = $_POST['queryUpdateBirthday']['birthday'];
        $bdayYear = date('Y', strtotime($birthday));
        $currentYear = date('Y');
        $age = $currentYear - $bdayYear;
        // echo $id." ".$role." ".$birthday." ".$bdayYear." ".$currentYear." ".$age;
        $updateBirthday = $account->updateBirthday($id, $birthday, $age, $role);
        if ($updateBirthday) {
            echo "success";
        } else {
            echo "failed";
        }
    }

    // Update address
    if (isset($_POST['queryUpdateAddress'])) {
        $id = $_POST['queryUpdateAddress']['id'];
        $role = $_POST['queryUpdateAddress']['role'];
        $address = $_POST['queryUpdateAddress']['address'];
        $updateAddress = $account->updateAddress($id, $address, $role);
        if ($updateAddress) {
            echo "success";
        } else {
            echo "failed";
        }
    }

    // Update contact number
    if (isset($_POST['queryUpdateContactNo'])) {
        $id = $_POST['queryUpdateContactNo']['id'];
        $role = $_POST['queryUpdateContactNo']['role'];
        $contact_no = $_POST['queryUpdateContactNo']['contact_no'];
        $updateContactNo = $account->updateContactNo($id, $contact_no, $role);
        if ($updateContactNo) {
            echo "success";
        } else {
            echo "failed";
        }
    }

    // Update password
    if (isset($_POST['queryUpdatePassword'])) {
        $id = $_POST['queryUpdatePassword']['id'];
        $role = $_POST['queryUpdatePassword']['role'];
        $user_password = $_POST['queryUpdatePassword']['user_password'];
        $old_password = md5($_POST['queryUpdatePassword']['old_password']);
        $new_password = $_POST['queryUpdatePassword']['new_password'];
        $confirm_password = $_POST['queryUpdatePassword']['confirm_password'];
        if ($user_password === $old_password) {
            if ($new_password === $confirm_password) {
                $password = md5($new_password);
                $updatePassword = $account->updatePassword($id, $password, $role);
                if ($updatePassword) {
                    echo "success";
                } else {
                    echo "failed";
                }
            } else {
                echo "incorrect_confirm_password";
            }
        } else {
            echo "incorrect_old_password";
        }
    }