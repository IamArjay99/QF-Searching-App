<?php

// Default time zone
date_default_timezone_set('Asia/Manila');

class Rooms extends Database {

    // Getting all the rooms in the database
    public function getAllRooms($cityID) {
        $sql = "SELECT * FROM rooms WHERE city_id = ? AND deleted_at IS ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([$cityID, NULL]);
        return $query->fetchAll();
    }

    // Get specific room
    public function getRoom($cityID, $roomID) {
        $sql = "SELECT * FROM rooms WHERE id = ? AND city_id = ? AND deleted_at IS ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([$roomID, $cityID, NULL]);
        return $query->fetch();
    }

    // Check if the room name existed before adding
    public function checkRoomName($name, $cityID) {
        $sql = "SELECT * FROM rooms WHERE name = ? AND city_ID = ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([$name, $cityID]);
        return $query;
    }

    // Check if the room name existed before update
    public function checkUpdateRoomName($id, $name, $cityID) {
        $sql = "SELECT * FROM rooms WHERE id != ? AND city_id = ? AND name = ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([$id, $cityID, $name]);
        return $query;
    }

    // Updating the room in the database
    public function updateRoom($cityID, $roomID, $name, $maxCapacity) {
        $sql = "UPDATE rooms 
                SET name = ?, max_capacity = ? 
                WHERE id = ? AND city_id = ? AND deleted_at IS ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([$name, $maxCapacity, $roomID, $cityID, NULL]);
        return $query;
    }

    // Adding room to the database
    public function addRoom($cityID, $name, $maxCapacity) {
        $sql = "INSERT INTO rooms 
                (city_id, name, max_capacity) 
                VALUES
                (?, ?, ?)";
        $query = $this->connect()->prepare($sql);
        $query->execute([$cityID, $name, $maxCapacity]);
        return $query;
    }
    
    // Deleting room to the database
    public function deleteRoom($id) {
        $sql = "UPDATE rooms 
                SET deleted_at = ? 
                WHERE id = ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([date('Y-m-d h:i:s'), $id]);
        return $query;
    }

    // Getting all the archived rooms
    public function getAllArchivedRooms($id) {
        $sql = "SELECT * FROM rooms WHERE city_id = ? AND deleted_at IS NOT ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([$id, NULL]);
        return $query->fetchAll();
    }

    // Restore room
    public function restoreRoom($roomID, $cityID) {
        $sql = "UPDATE rooms 
        SET deleted_at = ? 
        WHERE id = ? AND city_id = ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([null, $roomID, $cityID]);
        return $query;
    }

    // Permanent delete room
    public function permanentDeleteRoom($roomID, $cityID) {
        $sql = "DELETE FROM rooms WHERE id = ? AND city_id = ? AND deleted_at IS NOT ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([$roomID, $cityID, null]);
        return $query;
    }

}