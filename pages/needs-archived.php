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
    <main class="needs-archived-main" id="content">
        <article>
            <h2 class="text-center pt-5"><?= $cityName ?> Quarantine Facility</h2>
            <h4 class="text-center mb-4">Needs Archived</h4>
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Stocks</th>
                                <th>&nbsp</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $getAllNeedsArchived = $needs->getAllNeedsArchived($cityID);
                        if (count($getAllNeedsArchived) > 0) {
                            $count = 1;
                            foreach($getAllNeedsArchived as $need) {
                                $output = "";
                                if ($need['stock'] <= 10) {
                                    $output .= "<tr class='bg-warning'>";
                                    $output .= "<td>".$count."</td>";
                                    if ($need['stock'] <= 0) $output .= "<td><del>".$need['type']."</del></td>";
                                    else $output .= "<td>".$need['type']."</td>";
                                } else {
                                    $output .= "<tr>";
                                    $output .= "<td>".$count."</td>";
                                    $output .= "<td>".$need['type']."</td>";
                                }
                                $output .= "<td>".$need['stock']."</td>";
                                $output .= "<td>";
                                $output .= '<button type="button" class="btn btn-success restoreNeed" title="Restore Need" data-id="'.$need["id"].'" data-city_id="'.$cityID.'" data-name="'.$need['type'].'"><i class="fa fa-window-restore" aria-hidden="true"></i></button>';
                                $output .= '<button class="btn btn-danger permanentDeleteNeed" title="Permanent Delete" data-id="'.$need["id"].'" data-city_id="'.$cityID.'" data-name="'.$need['type'].'"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                                $output .= "</td>";
                                echo $output;
                                $count += 1;
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center'>No data found</td></tr>";
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
    <script src="../dist/js/needs-archived.js"></script>
<?php endblock() ?>



