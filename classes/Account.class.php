<?php

    class Account extends Database {

        // Get Account
        public function getAccount($id, $role) {
            if ($role === "admin") {
                $sql = "SELECT * FROM admins WHERE id = ? AND role = ? AND deleted_at IS ?";
                $query = $this->connect()->prepare($sql);
                $query->execute([$id, $role, NULL]);
                $result = $query->fetch();
                return $result;
            } else {
                $sql = "SELECT * FROM patients WHERE id = ? AND role = ? AND deleted_at IS ?";
                $query = $this->connect()->prepare($sql);
                $query->execute([$id, $role, NULL]);
                $result = $query->fetch();
                return $result;
            }
        }

        // Check Username
        public function checkUsername($id, $username, $role) {
            // For admin
            if ($role === "admin") {
                $sql = "SELECT * FROM admins WHERE id != ? AND username = ? AND role = ? AND deleted_at IS ?";
                $query = $this->connect()->prepare($sql);
                $query->execute([$id, $username, $role, NULL]);
                return $query;
            } 
            // It is patient
            else {
                $sql = "SELECT * FROM patients WHERE id != ? AND username = ? AND role = ? AND deleted_at IS ?";
                $query = $this->connect()->prepare($sql);
                $query->execute([$id, $username, $role, NULL]);
                return $query;
            }
        }

        // Check Email
        public function checkEmail($id, $email, $role) {
            // For admin
            if ($role === "admin") {
                $sql = "SELECT * FROM admins WHERE id != ? AND email = ? AND role = ? AND deleted_at IS ?";
                $query = $this->connect()->prepare($sql);
                $query->execute([$id, $email, $role, NULL]);
                return $query;
            } 
            // It is patient
            else {
                $sql = "SELECT * FROM patients WHERE id != ? AND email = ? AND role = ? AND deleted_at IS ?";
                $query = $this->connect()->prepare($sql);
                $query->execute([$id, $email, $role, NULL]);
                return $query;
            }
        }

        // Update Full Name
        public function updateFullname($id, $fullname, $role) {
            // For admin
            if ($role === "admin") {
                $sql = "UPDATE admins SET fullname = ? WHERE id = ? AND role = ? AND deleted_at IS ?";
                $query = $this->connect()->prepare($sql);
                $query->execute([$fullname, $id, $role, NULL]);
                return $query;
            } 
            // It is patient
            else {
                $sql = "UPDATE patients SET fullname = ? WHERE id = ? AND role = ? AND deleted_at IS ?";
                $query = $this->connect()->prepare($sql);
                $query->execute([$fullname, $id, $role, NULL]);
                return $query;
            }
        }

        // Update Username
        public function updateUsername($id, $username, $role) {
            // For admin
            if ($role === "admin") {
                $sql = "UPDATE admins SET username = ? WHERE id = ? AND role = ? AND deleted_at IS ?";
                $query = $this->connect()->prepare($sql);
                $query->execute([$username, $id, $role, NULL]);
                return $query;
            } 
            // It is patient
            else {
                $sql = "UPDATE patients SET username = ? WHERE id = ? AND role = ? AND deleted_at IS ?";
                $query = $this->connect()->prepare($sql);
                $query->execute([$username, $id, $role, NULL]);
                return $query;
            }
        }

        // Update Email
        public function updateEmail($id, $email, $role) {
            // For admin
            if ($role === "admin") {
                $sql = "UPDATE admins SET email = ? WHERE id = ? AND role = ? AND deleted_at IS ?";
                $query = $this->connect()->prepare($sql);
                $query->execute([$email, $id, $role, NULL]);
                return $query;
            } 
            // It is patient
            else {
                $sql = "UPDATE patients SET email = ? WHERE id = ? AND role = ? AND deleted_at IS ?";
                $query = $this->connect()->prepare($sql);
                $query->execute([$email, $id, $role, NULL]);
                return $query;
            }
        }

        // Update Email
        public function updatePassword($id, $password, $role) {
            // For admin
            if ($role === "admin") {
                $sql = "UPDATE admins SET password = ? WHERE id = ? AND role = ? AND deleted_at IS ?";
                $query = $this->connect()->prepare($sql);
                $query->execute([$password, $id, $role, NULL]);
                return $query;
            } 
            // It is patient
            else {
                $sql = "UPDATE patients SET password = ? WHERE id = ? AND role = ? AND deleted_at IS ?";
                $query = $this->connect()->prepare($sql);
                $query->execute([$password, $id, $role, NULL]);
                return $query;
            }
        }

        // Update Birthday
        public function updateBirthday($id, $birthday, $age, $role) {
            $sql = "UPDATE patients SET birthday = ?, age = ? WHERE id = ? AND role = ? AND deleted_at IS ?";
            $query = $this->connect()->prepare($sql);
            $query->execute([$birthday, $age, $id, $role, NULL]);
            return $query;
        }

        // Update Address
        public function updateAddress($id, $address, $role) {
            $sql = "UPDATE patients SET address = ? WHERE id = ? AND role = ? AND deleted_at IS ?";
            $query = $this->connect()->prepare($sql);
            $query->execute([$address, $id, $role, NULL]);
            return $query;
        }

        // Update Contact Number
        public function updateContactNo($id, $contact_no, $role) {
            $sql = "UPDATE patients SET contact_no = ? WHERE id = ? AND role = ? AND deleted_at IS ?";
            $query = $this->connect()->prepare($sql);
            $query->execute([$contact_no, $id, $role, NULL]);
            return $query;
        }

        // Update City and Room
        public function updatePatientCityRoom($id, $role, $city, $room) {
            $sql = "UPDATE patients SET city_id = ?, room_id = ? WHERE id = ? AND role = ? AND deleted_at IS ?";
            $query = $this->connect()->prepare($sql);
            $query->execute([$city, $room, $id, $role, NULL]);
            return $query;
        }

        // Update Room
        public function updatePatientRoom($id, $role, $room) {
            $sql = "UPDATE patients SET room_id = ? WHERE id = ? AND role = ? AND deleted_at IS ?";
            $query = $this->connect()->prepare($sql);
            $query->execute([$room, $id, $role, NULL]);
            return $query;
        }

        // Update Status
        public function updatePatientStatus($id, $role, $status) {
            $sql = "UPDATE patients SET status = ? WHERE id = ? AND role = ? AND deleted_at IS ?";
            $query = $this->connect()->prepare($sql);
            $query->execute([$status, $id, $role, NULL]);
            return $query;
        }

    }