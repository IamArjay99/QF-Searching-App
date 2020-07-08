<?php 
    include '../layouts/d-layout.php';

    // Checking if the id of the city is set
    if (isset($_GET['id']) && isset($_SESSION['data'])) {
        $cityID = $_GET['id'];
        $city = $cities->getCity($cityID);
        $cityName = $city['name'];
        if (!strpos($cityName, 'City')) {
            $cityName .= " City";
        }
        $getAllNeeds = $needs->getAllNeeds($cityID);
    } else {
        echo "<script>window.history.back();</script>";
    }
?>

<?php startblock('another_css') ?>
<?php endblock() ?>

<?php startblock('main_content') ?>
    <main class="needs-details-main" id="content">
        <article>
            <h2 class="text-center pt-5"><?= $cityName ?> Quarantine Facility</h2>
            <h4 class="text-center mb-4">Needs</h4>
            <div class="row">
                <?php if ($user_role === "admin") { ?>
                    <div class="float-right mb-2">
                        <a href="needs-history.php?id=<?= $cityID ?>" class="btn btn-secondary"><i class="fa fa-folder" aria-hidden="true"></i> View History</a>
                        <a href="needs-archived.php?id=<?= $cityID ?>" class="btn btn-info"><i class="fa fa-folder" aria-hidden="true"></i> View Archived</a>
                        <button class="btn btn-primary" id="btn-add-need">Add Another Needs</button>
                    </div>
                <?php } ?>
                <div class="table table-responsive">
                    <table class="table table-bordered table-hover table-striped text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Stocks</th>
                                <?php if ($_SESSION['data']['role'] === "admin") { ?>
                                <th>&nbsp</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if (count($getAllNeeds) > 0) {
                            $count = 1;
                                foreach($getAllNeeds as $need) {
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
                                    if ($_SESSION['data']['role'] === "admin") { 
                                        $output .= "<td><div class='btn-group'>";
                                        $output .= "<button class='btn btn-primary btn-edit-need' data-name=".$need['type']." data-stock=".$need['stock']." data-id=".$need['id'].">Edit</button>";
                                        $output .= "<button class='btn btn-danger btn-delete-need' data-name=".$need['type']." data-id=".$need['id'].">Delete</button>";
                                        $output .= "</div></td>";
                                    }
                                    echo $output;
                                    $count += 1;
                                } 
                            } else {
                                if ($_SESSION['data']['role'] === "admin") {
                                    echo "<tr><td colspan='4'>No data found</td></tr>";
                                } else {
                                    echo "<tr><td colspan='3'>No data found</td></tr>";
                                }
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </article> 
    </main>

    <!-- Add Need Modal -->
    <div class="modal fade" id="addneedModal">
        <form method="POST">
            <div class="modal-content" id="modal-add-need">
                <div class="modal-header">
                    <h5 class="modal-title" id="addneedModalLabel">Add need</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="add-error-message py-2 mb-3" id="add-error-message" style="display: none"></div>
                    <input type="hidden" name="city-id" id="add-city-id" value="<?= $cityID ?>">
                    <div class="form-group">
                        <label for="add-need-name">Name</label>
                        <input class="form-control" type="text" id="add-need-name" name="add-need-name" required>
                    </div>
                    <div class="form-group">
                        <label for="add-need-stock">Stocks</label>
                        <input class="form-control" type="number" id="add-need-stock" name="add-need-stock" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancel" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="save" id="btn-save-need">Save Needs</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Edit Need Modal -->
    <div class="modal fade" id="editNeedModal">
        <form method="POST">
            <div class="modal-content" id="modal-edit-need">
                <div class="modal-header">
                    <h5 class="modal-title" id="editNeedModalLabel">Add need</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="edit-error-message py-2 mb-3" id="edit-error-message" style="display: none"></div>
                    <input type="hidden" name="city-id" id="edit-city-id" value="<?= $cityID ?>">
                    <input type="hidden" name="need-id" id="edit-need-id">
                    <div class="form-group">
                        <label for="edit-need-name">Name</label>
                        <input class="form-control" type="text" id="edit-need-name" name="edit-need-name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-need-stock">Stocks</label>
                        <input class="form-control" type="number" id="edit-need-stock" name="edit-need-stock" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancel" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="save" id="btn-edit-save-need">Save Needs</button>
                </div>
            </div>
        </form>
    </div>
<?php endblock() ?>

<?php startblock('another_js') ?>
    <script src="../dist/js/needs-details.js"></script>
<?php endblock() ?>



