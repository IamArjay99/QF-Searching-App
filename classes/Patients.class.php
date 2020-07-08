<?php

// Default time zone
date_default_timezone_set('Asia/Manila');

class Patients extends Database {

    // Get all patient
    public function getAllPatients($cityID) {
        $sql = "SELECT * FROM patients WHERE city_id = ? AND deleted_at IS ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([$cityID, null]);
        $result = $query->fetchAll();
        return $result;
    }

    // Get patient request message
    public function getPatientRequest($id) {
        $sql = "SELECT * FROM patients WHERE id = ? AND deleted_at IS ? ORDER BY created_at DESC";
        $query = $this->connect()->prepare($sql);
        $query->execute([$id, NULL]);
        $result = $query->fetch();
        return $result;
    }

    // Get specific patient
    public function getPatient($id) {
        $sql = "SELECT * FROM patients WHERE id = ? AND deleted_at IS ? ORDER BY created_at DESC";
        $query = $this->connect()->prepare($sql);
        $query->execute([$id, NULL]);
        $result = $query->fetch();
        return $result;
    }

    // Get PUI Patient
    public function getRoomPatientPUI($roomID, $cityID, $status) {
        $sql = "SELECT * FROM patients WHERE room_id = ? AND city_id = ? AND status = ? AND deleted_at IS ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([$roomID, $cityID, $status, null]);
        $result = $query->fetchAll();
        return $result;
    }

    // Get PUM Patient
    public function getRoomPatientPUM($roomID, $cityID, $status) {
        $sql = "SELECT * FROM patients WHERE room_id = ? AND city_id = ? AND status = ? AND deleted_at IS ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([$roomID, $cityID, $status, null]);
        $result = $query->fetchAll();
        return $result;
    }

    // Get Active Patient
    public function getRoomPatientActive($roomID, $cityID, $status) {
        $sql = "SELECT * FROM patients WHERE room_id = ? AND city_id = ? AND status = ? AND deleted_at IS ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([$roomID, $cityID, $status, null]);
        $result = $query->fetchAll();
        return $result;
    }

    // Get Recovered Patient
    public function getRoomPatientRecovered($roomID, $cityID, $status) {
        $sql = "SELECT * FROM patients WHERE room_id = ? AND city_id = ? AND status = ? AND deleted_at IS ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([$roomID, $cityID, $status, null]);
        $result = $query->fetchAll();
        return $result;
    }

    // Get Died Patient
    public function getRoomPatientDied($roomID, $cityID, $status) {
        $sql = "SELECT * FROM patients WHERE room_id = ? AND city_id = ? AND status = ? AND deleted_at IS ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([$roomID, $cityID, $status, null]);
        $result = $query->fetchAll();
        return $result;
    }

    // Get All Patient in Room
    public function getRoomPatientTotal($roomID, $cityID) {
        $sql = "SELECT * FROM patients WHERE room_id = ? AND city_id = ? AND deleted_at IS ? ORDER BY status";
        $query = $this->connect()->prepare($sql);
        $query->execute([$roomID, $cityID, null]);
        $result = $query->fetchAll();
        return $result;
    }

    // Get All PUI Patiets in City
    public function getCityPatientPUI($cityID, $status) {
        $sql = "SELECT * FROM patients WHERE city_id = ? AND status = ? AND deleted_at IS ? ORDER BY status";
        $query = $this->connect()->prepare($sql);
        $query->execute([$cityID, $status, null]);
        $result = $query->fetchAll();
        return $result;
    }

    // Get All PUM Patiets in City
    public function getCityPatientPUM($cityID, $status) {
        $sql = "SELECT * FROM patients WHERE city_id = ? AND status = ? AND deleted_at IS ? ORDER BY status";
        $query = $this->connect()->prepare($sql);
        $query->execute([$cityID, $status, null]);
        $result = $query->fetchAll();
        return $result;
    }

    // Get All Active Patiets in City
    public function getCityPatientActive($cityID, $status) {
        $sql = "SELECT * FROM patients WHERE city_id = ? AND status = ? AND deleted_at IS ? ORDER BY status";
        $query = $this->connect()->prepare($sql);
        $query->execute([$cityID, $status, null]);
        $result = $query->fetchAll();
        return $result;
    }

    // Get All Recovered Patiets in City
    public function getCityPatientRecovered($cityID, $status) {
        $sql = "SELECT * FROM patients WHERE city_id = ? AND status = ? AND deleted_at IS ? ORDER BY status";
        $query = $this->connect()->prepare($sql);
        $query->execute([$cityID, $status, null]);
        $result = $query->fetchAll();
        return $result;
    }

    // Get All Recovered Patiets in City
    public function getCityPatientDied($cityID, $status) {
        $sql = "SELECT * FROM patients WHERE city_id = ? AND status = ? AND deleted_at IS ? ORDER BY status";
        $query = $this->connect()->prepare($sql);
        $query->execute([$cityID, $status, null]);
        $result = $query->fetchAll();
        return $result;
    }

    // Get Total Patiets in City
    public function getCityTotalPatient($cityID) {
        $sql = "SELECT * FROM patients WHERE city_id = ? AND status IS NOT ? AND deleted_at IS ? ORDER BY status";
        $query = $this->connect()->prepare($sql);
        $query->execute([$cityID, NULL, NULL]);
        $result = $query->fetchAll();
        return $result;
    }

    // Update info when requesting quarantine
    public function updatePatientInfo($id, $address, $cityID) {
        $sql = "UPDATE patients SET address = ?, city_id = ? WHERE id = ? AND deleted_at IS ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([$address, $cityID, $id, NULL]);
        return $query;
    }

    // Update patient based on request
    public function updatePatientStatus($id, $room, $status) {
        $sql = "UPDATE patients SET room_id = ?, status = ? WHERE id = ? AND deleted_at IS ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([$room, $status, $id, NULL]);
        return $query;
    }

}