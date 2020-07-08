<?php


class Status extends Database {
    
    public function getAllStatus() {
        $sql = "SELECT * FROM status WHERE deleted_at IS ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([NULL]);
        $result = $query->fetchAll();
        return $result;
    }
    
}