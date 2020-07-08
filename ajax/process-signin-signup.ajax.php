<?php
    session_start();
    include_once '../classes/Database.class.php';

    class Signin extends Database {
        public function checkAdminSignin($email, $password) {
            $sql = "SELECT * FROM admins WHERE email = ? AND password = ?";
            $query = $this->connect()->prepare($sql);
            $query->execute([$email, $password]);
            return $query->fetch();
        }

        public function checkPatientSignin($email, $password) {
            $sql = "SELECT * FROM patients WHERE email = ? AND password = ?";
            $query = $this->connect()->prepare($sql);
            $query->execute([$email, $password]);
            return $query->fetch();
        }
    }

    class Signup extends Database {
        public function checkSignUp($username, $email) {
            $sql = "SELECT * FROM patients WHERE username = ? OR email = ? AND deleted_at IS ?";
            $query = $this->connect()->prepare($sql);
            $query->execute([$username, $email, NULL]);
            return $query;
        }

        public function insertSignup($data) {
            $sql = "INSERT INTO patients 
                    (username, password, fullname, age, birthday, email, role) 
                    VALUES
                    (?, ?, ?, ?, ?, ?, ?)";
            $query = $this->connect()->prepare($sql);
            $query->execute([$data['username'], $data['password'], $data['fullname'], $data['age'], $data['birthday'], $data['email'], "patient"]);
            return $query;
        }
    }

    $signin = new Signin();
    $signup = new Signup();

    if (isset($_POST['querySignin'])) {
        $email = $_POST['querySignin']['email'];
        $password = md5($_POST['querySignin']['password']);
        $authAdmin = $signin->checkAdminSignin($email, $password);
        if ($authAdmin) {
            $data = [
                "id" => $authAdmin["id"],
                "fullname" => $authAdmin["fullname"],
                "username" => $authAdmin['username'],
                "email" => $authAdmin["email"],
                "password" => $authAdmin["password"],
                "role" => $authAdmin["role"]
            ];
            $_SESSION['data'] = $data;
            echo "true";
        } else {
            $authPatient = $signin->checkPatientSignin($email, $password);
            if ($authPatient) {
                $data = [
                    "id" => $authPatient["id"],
                    "fullname" => $authPatient["fullname"],
                    "username" => $authPatient['username'],
                    "email" => $authPatient["email"],
                    "password" => $authPatient["password"],
                    "birthday" => $authPatient["birthday"],
                    "contact_no" => $authPatient["contact_no"],
                    "role" => $authPatient["role"]
                ];
                $_SESSION['data'] = $data;
                echo "true";
            } else {
                echo "false";
            }
        }
    }

    if (isset($_POST['querySignup'])) {
        $fullname = $_POST['querySignup']['fullname'];
        $username = $_POST['querySignup']['username'];
        $email = $_POST['querySignup']['email'];
        $password = md5($_POST['querySignup']['password']);
        $birthday = $_POST['querySignup']['birthday'];
        $bdayYear = date('Y', strtotime($birthday));
        $currentYear = date('Y');
        $age = $currentYear - $bdayYear;
        $data = [
            'fullname' => $fullname,
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'birthday' => $birthday,
            'age' => $age
        ];
        $checkSignUp = $signup->checkSignUp($username, $email);
        if ($checkSignUp->rowCount() > 0) {
            echo "existed";
        } else {
            $insert = $signup->insertSignup($data);
            if ($insert) {
                echo "success";
            } else {
                echo "failed";
            }
        }
    }