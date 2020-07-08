<?php

// Default time zone
date_default_timezone_set('Asia/Manila');

class Needs extends Database {
    // Getting all the needs of the city
    public function getAllNeeds($cityID) {
        $sql = "SELECT * FROM needs WHERE city_id = ? AND deleted_at IS ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([$cityID, null]);
        $result = $query->fetchAll();
        return $result;
    }

    // Getting specific needs through id
    public function getNeedsById($id, $cityID) {
        $sql = "SELECT * FROM needs WHERE id = ? AND city_id = ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([$id, $cityID]);
        $result = $query->fetch();
        return $result;
    }

    // Getting specific needs
    public function getNeeds($cityID, $type) {
        $sql = "SELECT * FROM needs WHERE city_id = ? AND type = ? AND deleted_at IS ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([$cityID, $type, NULL]);
        $result = $query->fetch();
        return $result;
    }

    public function getAllNeedsArchived($cityID) {
        $sql = "SELECT * FROM needs WHERE city_id = ? AND deleted_at IS NOT ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([$cityID, null]);
        $result = $query->fetchAll();
        return $result;
    }

    // Check if the name/type of need is existing before insert
    public function checkNeeds($cityID, $type) {
        $sql = "SELECT * FROM needs WHERE city_id = ? AND type = ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([$cityID, $type]);
        return $query;
    }

    // Check if the name/type of need is existing before update
    public function checkUpdateNeeds($id, $cityID, $type) {
        $sql = "SELECT * FROM needs WHERE id != ? AND city_id = ? AND type = ? AND deleted_at IS ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([$id, $cityID, $type, null]);
        return $query;
    }

    // Inserting new need
    public function insertNeeds($cityID, $type, $stock) {
        $sql = "INSERT INTO needs 
                (city_id, type, stock) 
                VALUES (?, ?, ?)";
        $query = $this->connect()->prepare($sql);
        $query->execute([$cityID, $type, $stock]);
        return $query;
    }

    // Updating need
    public function updateNeeds($id, $cityID, $type, $stock) {
        $sql = "UPDATE needs SET type = ?, stock = ? WHERE id = ? AND city_id = ? AND deleted_at IS ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([$type, $stock, $id, $cityID, NULL]);
        return $query;
    }

    // Deleting need
    public function deleteNeeds($id) {
        $sql = "UPDATE needs SET deleted_at = ? WHERE id = ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([date('Y-m-d h:i:s'), $id]);
        return $query;
    }

    // Restore needs
    public function restoreNeeds($id, $cityID) {
        $sql = "UPDATE needs SET deleted_at = ? WHERE id = ? AND city_id = ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([NULL, $id, $cityID]);
        return $query;
    }

    // Permanently delete the need
    public function permanentDeleteNeed($id, $cityID) {
        $sql = "DELETE FROM needs WHERE id = ? AND city_id = ? AND deleted_at IS NOT ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([$id, $cityID, NULL]);
        return $query;
    }

    // <!---------- HISTORY LOG -----------------> //

    // Insert history log 
    public function insertNeedsLog($needID, $cityID, $stock) {
        $sql = "INSERT INTO need_history 
                (need_id, city_id, stock) 
                VALUES (?, ?, ?)";
        $query = $this->connect()->prepare($sql);
        $query->execute([$needID, $cityID, $stock]);
        return $query;
    }

    // Get history log
    public function getNeedsHistory($cityID) {
        $sql = "SELECT * FROM need_history WHERE city_id = ? AND deleted_at IS ? ORDER BY created_at DESC";
        $query = $this->connect()->prepare($sql);
        $query->execute([$cityID, NULL]);
        return $query->fetchAll();
    }

    // Clear all history log
    public function clearAllNeedsHistory($cityID) {
        $sql = "UPDATE need_history SET deleted_at = ? WHERE city_id = ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([date('Y-m-d h:i:s'), $cityID]);
        return $query;
    }

    // Delete history log
    public function deleteHistoryLog($id) {
        $sql = "UPDATE need_history SET deleted_at = ? WHERE id = ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([date('Y-m-d h:i:s'), $id]);
        return $query;
    }


}