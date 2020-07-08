<?php

    // This will include all the classes
    include_once '../includes/all.include.php';

    class Process extends Database {
        public function processSearchAll($search) {
            $sql = "SELECT * FROM cities WHERE deleted_at IS ? ORDER BY name";
            $query = $this->connect()->prepare($sql);
            $query->execute([null]);
            return $query;
        }
        public function processSearch($search) {
            $sql = "SELECT * FROM cities WHERE name LIKE ? ORDER BY name";
            $query = $this->connect()->prepare($sql);
            $query->execute(['%'.$search.'%']);
            return $query;
        }
    }

    $process = new Process();

    if (isset($_POST['query'])) {
        $query = $_POST['query'];
        $output = "";
        if ($query === '*') {
            $result = $process->processSearchAll($query);
        } else {
            $result = $process->processSearch($query);
        }
        if ($result->rowCount() > 0) {
            $results = $result->fetchAll();
            foreach($results as $result) {
                $output .= "<tr>";
                $output .= "<td>";
                $output .= "<span class='city-name'>".$result['name']."</span>";
                $output .= "<span class='city-details'>";
                $output .= "<a href='pages/city.php?id=". $result['id'] ."'>View Details</a>";
                $output .= "</span>";
                $output .= "</td>";
                $output .= "</tr>";
            }
        } else {
            $output .= "<tr><td class='text-center'>No data found</td></tr>";
        }
        echo $output;
    }

    

