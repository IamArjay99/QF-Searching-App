<?php

// Default time zone
date_default_timezone_set('Asia/Manila');

class Conversation extends Database {
    
    // Getting all conversation
    public function getAllConversation($to_id){
        $sql = "SELECT * FROM conversation WHERE to_id = ? AND deleted_at IS ? GROUP BY from_id ORDER BY created_at DESC";
        $query = $this->connect()->prepare($sql);
        $query->execute([$to_id, NULL]);
        $result = $query->fetchAll();
        return $result;
    }

    // Getting all conversation 
    public function getConversation($from_id, $to_id){
        $sql = "SELECT * FROM conversation WHERE (from_id = ? AND to_id = ?) OR (from_id = ? AND to_id = ?) AND deleted_at IS ? ORDER BY created_at ASC";
        $query = $this->connect()->prepare($sql);
        $query->execute([$from_id, $to_id, $to_id, $from_id, NULL]);
        $result = $query->fetchAll();
        return $result;
    }

    // Getting patient conversation 
    public function getPatientConversation($from_id, $role){
        $sql = "SELECT * FROM conversation WHERE from_id = ? AND role = ? AND deleted_at IS ? ORDER BY created_at ASC";
        $query = $this->connect()->prepare($sql);
        $query->execute([$from_id, $role, NULL]);
        $result = $query->fetchAll();
        return $result;
    }

    // Inserting new conversation/ Accept Message request
    public function insertNewConversation($to_id, $from_id, $message) {
        $sql = "INSERT INTO conversation (from_id, to_id, message, role, destination) VALUES (?,?,?,?,?)";
        $query = $this->connect()->prepare($sql);
        $query->execute([$to_id, $from_id, $message, "patient", "admin"]);
        return $query;
    }

    // Insert new message/reply
    public function insertMessage($from_id, $to_id, $role, $message) {
        $destination = "";
        if ($role === "admin") {
            $destination = "patient";
        } else {
            $destination = "admin";
        }
        $sql = "INSERT INTO conversation (from_id, to_id, role, destination, message) VALUES (?,?,?,?,?)";
        $query = $this->connect()->prepare($sql);
        $query->execute([$to_id, $from_id, $role, $destination, $message]);
        return $query;
    }


}