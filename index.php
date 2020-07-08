<?php 
    include 'layouts/layout.php';
?>

<?php startblock('another_css') ?>
<?php endblock() ?>

<?php startblock('main_content') ?>
    <main class="index">
        <article>
            <section class="metro-manila-svg">
                <p>
                    <span class="big-letter">Q</span>uarantine
                    <span class="big-letter">F</span>acilty Seaching App
                    allows you to search for the specific city in Metro
                    Manila, Philippines and find out what are the current
                    status of that city and allows you to request quarantine
                    if you think you are already infected with the Corona
                    Virus Disease 2019.
                </p>
            </section>
            <section class="list-of-cities">
                <h2>List of Cities</h2>
                <div class="input-group">
                    <i class="fa fa-search" aria-hidden="true"></i>
                    <input
                        type="text"
                        placeholder="Search city..."
                        name="searchCity"
                        id="searchCity"
                        autocomplete="off"
                    />
                </div>
                <div class="table-responsive">
                    <table id="table">
                        <?php 
                            $allCities = $cities->getAllCities();
                            foreach($allCities as $city) {
                                $cityName = $city['name'];
                                $cityID = $city['id'];
                        ?>
                        <tr>
                            <td>
                                <span class="city-name"><?= $cityName ?></span>
                                <span class="city-details">
                                    <a href="pages/city.php?id=<?= $cityID ?>">View Details</a>
                                </span>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </table>
                </div>
            </section>
        </article>
    </main>
<?php endblock() ?>

<?php startblock('another_js') ?>
    <!-- Dynamic Search -->
    <script src="dist/js/homepage.js"></script>
<?php endblock() ?>
