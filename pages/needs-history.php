<?php 
    include '../layouts/d-layout.php';

    if ($user_role !== "admin") {
        echo "<script>window.history.back();</script>";
    }

    // Checking if the id of the city is set
    if (isset($_GET['id']) && isset($_SESSION['data'])) {
        $cityID = $_GET['id'];
        $city = $cities->getCity($cityID);
        $cityName = $city['name'];
        if (!strpos($cityName, 'City')) {
            $cityName .= " City";
        }
        $getNeedsHistory = $needs->getNeedsHistory($cityID);
    } else {
        echo "<script>window.history.back();</script>";
    }
?>

<?php startblock('another_css') ?>
<?php endblock() ?>

<?php startblock('main_content') ?>
    <main class="needs-history-main" id="content">
        <article>
            <h2 class="text-center pt-5"><?= $cityName ?> Quarantine Facility</h2>
            <h4 class="text-center mb-4">Needs History</h4>
            <div class="row">
                <div class="table-responsive">
                    <div class="float-right mb-2">
                        <button class="btn btn-primary" id="btn-clear-all" data-id="<?= $cityID ?>">Clear All</button>
                    </div>
                    <table class="table table-bordered table-hover table-striped text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Stocks</th>
                                <th>Updated At</th>
                                <th>&nbsp</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if (count($getNeedsHistory) > 0) {
                                $count = 1;
                                foreach($getNeedsHistory as $need) {
                                    $needID = $need['need_id'];
                                    $getNeeds = $needs->getNeedsById($needID, $cityID);
                                    $stock = $need['stock'];
                                    $updatedAt = $need['created_at'];
                                    $output = "";
                                    $output .= "<tr>";
                                    $output .= "<td>".$count."</td>";
                                    if ($getNeeds['deleted_at'] != NULL) {
                                        $output .= "<td><del><span style='color: red'>".$getNeeds['type']."</span></del></td>";
                                    } else {
                                        $output .= "<td>".$getNeeds['type']."</td>";
                                    }
                                    $output .= "<td>".$stock."</td>";
                                    $output .= "<td>".$updatedAt."</td>";
                                    $output .= "<td><button class='btn btn-danger btnDelete' data-id='".$need['id']."' data-name='".$getNeeds['type']."'>Delete</button></td>";
                                    $output .= "</tr>";
                                    echo $output;
                                    $count += 1;
                                }
                            } else {
                                echo "<tr><td colspan='5'>No data found</td></tr>";
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </article> 
    </main>
<?php endblock() ?>

<?php startblock('another_js') ?>
    <script src="../dist/js/needs-history.js"></script>
<?php endblock() ?>



