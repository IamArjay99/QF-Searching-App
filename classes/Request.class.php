<?php

// Default time zone
date_default_timezone_set('Asia/Manila');

class Request extends Database {

    // Get all request
    public function getAllRequest() {
        $sql = "SELECT * FROM request WHERE deleted_at IS ? AND status IS ? GROUP BY patient_id ORDER BY created_at DESC";
        $query = $this->connect()->prepare($sql);
        $query->execute([NULL, NULL]);
        return $query->fetchAll();
    }

    // Get all accepted request
    public function getAllAcceptedRequest() {
        $sql = "SELECT * FROM request WHERE deleted_at IS ? AND status = ? GROUP BY patient_id ORDER BY created_at DESC";
        $query = $this->connect()->prepare($sql);
        $query->execute([NULL, "Accepted"]);
        return $query->fetchAll();
    }

    // Get specific patient request
    public function getRequest($id) {
        $sql = "SELECT * FROM request WHERE patient_id = ? AND deleted_at IS ? ORDER BY created_at ASC";
        $query = $this->connect()->prepare($sql);
        $query->execute([$id, NULL]);
        return $query->fetchAll();
    }

    // Insert Request to the database
    public function insertRequest($id, $message) {
        $sql = "INSERT INTO request (patient_id, message, deleted_at) VALUES (?, ?, ?)";
        $query = $this->connect()->prepare($sql);
        $query->execute([$id, $message, NULL]);
        return $query;
    }

    // Update Request Accepted to the database
    public function updateRequest($id) {
        $sql = "UPDATE request SET status = ? WHERE patient_id = ? AND deleted_at IS ?";
        $query = $this->connect()->prepare($sql);
        $query->execute(['Accepted', $id, NULL]);
        return $query;
    }

    // Update Request Rejected to the database
    public function updateRequestRejected($id) {
        $sql = "UPDATE request SET status = ? WHERE patient_id = ? AND deleted_at IS ?";
        $query = $this->connect()->prepare($sql);
        $query->execute(['Rejected', $id, NULL]);
        return $query;
    }

    // Update Request status to done in database
    public function updateRequestDone($id) {
        $sql = "UPDATE request SET status = ? WHERE patient_id = ? AND deleted_at IS ?";
        $query = $this->connect()->prepare($sql);
        $query->execute(['Done', $id, NULL]);
        return $query;
    }

}