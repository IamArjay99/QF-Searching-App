<?php

    // This will include all the classes
    include_once '../includes/all.include.php';

    // For updating the room
    if (isset($_POST['queryUpdateRoom'])) {
        $data = $_POST['queryUpdateRoom'];
        $checkUpdateRoomName = $rooms->checkUpdateRoomName($data['room-id'], $data['room-name'], $data['city-id']);
        if ($checkUpdateRoomName->rowCount() > 0) {
            echo "existed";
        } else {
            $updateRoom = $rooms->updateRoom($data['city-id'], $data['room-id'], $data['room-name'], $data['room-max_capacity']);
            if ($updateRoom) {
                echo "success";
            } else {
                echo "failed";
            }
        }
    }

    // For adding the room
    if (isset($_POST['queryAddedRoom'])) {
        $data = $_POST['queryAddedRoom'];
        $checkRoomName = $rooms->checkRoomName($data['room-name'], $data['city-id']);
        if ($checkRoomName->rowCount() > 0) {
            echo "existed";
        } else {
            $addRoom = $rooms->addRoom($data['city-id'], $data['room-name'], $data['room-max_capacity']);
            if ($addRoom) {
                echo "success";
            } else {
                echo "failed";
            }
        }
    }

    // For deleting the room
    if (isset($_POST['queryDeleteRoom'])) {
        $data = $_POST['queryDeleteRoom'];
        $deleteRoom = $rooms->deleteRoom($data);
        if ($deleteRoom) {
            echo "success";
        } else {
            echo "failed";
        }
    }

    // For restoring the room
    if (isset($_POST['queryRestoreRoom'])) {
        $data = $_POST['queryRestoreRoom'];
        $restoreRoom = $rooms->restoreRoom($data['roomID'], $data['cityID']);
        if ($restoreRoom) {
            echo "success";
        } else {
            echo "failed";
        }
    }

    // For permanently deleting the room
    if (isset($_POST['queryPermanentDeleteRoom'])) {
        $data = $_POST['queryPermanentDeleteRoom'];
        $permanentDeleteRoom = $rooms->permanentDeleteRoom($data['roomID'], $data['cityID']);
        if ($permanentDeleteRoom) {
            echo "success";
        } else {
            echo "failed";
        }
    }
    