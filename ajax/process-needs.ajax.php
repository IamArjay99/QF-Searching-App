<?php

    // This will include all the classes
    include_once '../includes/all.include.php';

    // Adding need to the database
    if (isset($_POST['queryAddNeeds'])) {
        $cityID = $_POST['queryAddNeeds']['city_id'];
        $name = $_POST['queryAddNeeds']['name'];
        $stock = $_POST['queryAddNeeds']['stock'];
        $checkNeeds = $needs->checkNeeds($cityID, $name);
        if ($checkNeeds->rowCount() > 0) {
            echo "existed";
        } else {
            $insertNeeds = $needs->insertNeeds($cityID, $name, $stock);
            if ($insertNeeds) {
                $getNeeds = $needs->getNeeds($cityID, $name);
                $id = $getNeeds['id'];
                // Insert history log
                $insertNeedsLog = $needs->insertNeedsLog($id, $cityID, $stock);
                if ($insertNeedsLog) {
                    echo "success";
                } else {
                    echo "failed";
                }
            } else {
                echo "failed";
            }
        }
    }

    // Updating need to the database
    if (isset($_POST['queryEditNeeds'])) {
        $id = $_POST['queryEditNeeds']['need_id'];
        $cityID = $_POST['queryEditNeeds']['city_id'];
        $name = $_POST['queryEditNeeds']['name'];
        $stock = $_POST['queryEditNeeds']['stock'];
        $checkUpdateNeeds = $needs->checkUpdateNeeds($id, $cityID, $name);
        if ($checkUpdateNeeds->rowCount() > 0) {
            echo "existed";
        } else {
            // Insert history log
            $insertNeedsLog = $needs->insertNeedsLog($id, $cityID, $stock);
            if ($insertNeedsLog) {
                $updateNeeds = $needs->updateNeeds($id, $cityID, $name, $stock);
                if ($updateNeeds) {
                    echo "success";
                } else {
                    echo "failed";
                }
            } else {
                echo "failed";
            }
        }
    } 

    // Deleting the need to the database 
    if (isset($_POST['queryDeleteNeed'])) {
        $needID = $_POST['queryDeleteNeed'];
        $deleteNeeds = $needs->deleteNeeds($needID);
        if ($deleteNeeds) {
            echo "success";
        } else {
            echo "failed";
        }
    }

    // Restoring the need
    if (isset($_POST['queryRestoreNeed'])) {
        $id = $_POST['queryRestoreNeed']['id'];
        $cityID = $_POST['queryRestoreNeed']['cityID'];
        $restoreNeed = $needs->restoreNeeds($id, $cityID);
        if ($restoreNeed) {
            echo "success";
        } else {
            echo "failed";
        }
    }

    // Permanently delete the need
    if (isset($_POST['queryPermanentDeleteNeed'])) {
        $id = $_POST['queryPermanentDeleteNeed']['id'];
        $cityID = $_POST['queryPermanentDeleteNeed']['cityID'];
        $permanentDeleteNeed = $needs->permanentDeleteNeed($id, $cityID);
        if ($permanentDeleteNeed) {
            echo "success";
        } else {
            echo "failed";
        }
    }

    // Clearing all history
    if (isset($_POST['queryClearAllHistoryLog'])) {
        $cityID = $_POST['queryClearAllHistoryLog'];
        $clearAllNeedsHistory = $needs->clearAllNeedsHistory($cityID);
        if ($clearAllNeedsHistory) {
            echo "success";
        } else {
            echo "failed";
        }
    }

    // Deleting history
    if (isset($_POST['queryDeleteHistoryLog'])) {
        $id = $_POST['queryDeleteHistoryLog'];
        $deleteHistoryLog = $needs->deleteHistoryLog($id);
        if ($deleteHistoryLog) {
            echo "success";
        } else {
            echo "failed";
        }
    }