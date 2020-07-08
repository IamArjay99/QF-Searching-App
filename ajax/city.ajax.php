<?php

    include_once '../includes/all.include.php';

    if (isset($_POST['queryNeeds'])) {
        $cityID = $_POST['queryNeeds'];
        $cityNeeds = $needs->getAllNeeds($cityID);
        echo json_encode($cityNeeds);
    }

    if (isset($_POST['queryPatients'])) {
        $cityID = $_POST['queryPatients'];
        $cityPatients = $patients->getAllPatients($cityID);
        echo json_encode($cityPatients);
    }

    

    

