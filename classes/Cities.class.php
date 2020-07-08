<?php

// Default time zone
date_default_timezone_set('Asia/Manila');

class Cities extends Database {
    
    public function getAllCities() {
        $sql = "SELECT * FROM cities WHERE deleted_at IS ? ORDER BY name";
        $query = $this->connect()->prepare($sql);
        $query->execute([null]);
        $result = $query->fetchAll();
        return $result;
    }

    public function getCity($id) {
        $sql = "SELECT * FROM cities WHERE id = ? AND deleted_at IS ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([$id, null]);
        $result = $query->fetch();
        return $result;
    }

}