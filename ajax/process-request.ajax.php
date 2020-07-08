<?php

    // This will include all the classes
    include_once '../includes/all.include.php';

    if (isset($_POST['queryRequest'])) {
        $data = $_POST['queryRequest'];
        $id = $data['id'];
        $address = $data['address'];
        $city = $data['city'];
        $message = $data['message'];
        $updatePatientInfo = $patients->updatePatientInfo($id, $address, $city);
        if ($updatePatientInfo) {
            $insertRequest = $request->insertRequest($id, $message);
            if ($insertRequest) {
                echo "success";
            } else {
                echo "failed";
            }
        } else {
            echo "failed";
        }
    }

    if (isset($_POST['queryProcessRequest'])) {
        $id = $_POST['queryProcessRequest']['id'];
        $room = $_POST['queryProcessRequest']['room'];
        $status = $_POST['queryProcessRequest']['status'];
        $updatePatientStatus = $patients->updatePatientStatus($id, $room, $status);
        if ($updatePatientStatus) {
            $updateRequestDone = $request->updateRequestDone($id);
            if ($updateRequestDone) {
                echo "success";
            } else {
                echo "failed";
            }
        } else {
            echo "failed";
        }
    }