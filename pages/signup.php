<?php 
    include '../layouts/layout.php';

    if (isset($_SESSION['data'])) {
        echo "<script>window.location='".(strpos($url, 'pages') !== false ? "" : "pages/")."dashboard.php';</script>";
    }
?>

<?php startblock('another_css') ?>
<?php endblock() ?>

<?php startblock('main_content') ?>
    <main class="signup">
        <article>
            <h2 class="page-title"></h2>
            <div class="signup-content">
                <div class="signup-box">
                    <div class="signup-header">Sign Up</div>
                    <div class="signup-body">
                        <form class="form-signin" method="POST" id="form-signup">
                            <div class="alert" id="error-feedback" style="display: none"></div>
                            <div class="form-group">
                                <label for="inputFullName">Full Name</label>
                                <input
                                    type="text"
                                    name="inputFullName"
                                    id="inputFullName"
                                    placeholder="Full Name"
                                />
                            </div>
                            <div class="form-group">
                                <label for="inputUsername">Username</label>
                                <input
                                    type="text"
                                    name="inputUsername"
                                    id="inputUsername"
                                    placeholder="Username"
                                />
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">Email</label>
                                <input
                                    type="email"
                                    name="inputEmail"
                                    id="inputEmail"
                                    placeholder="Email"
                                />
                            </div>
                            <div class="form-group">
                                <label for="inputPassword">Password</label>
                                <input
                                    type="password"
                                    name="inputPassword"
                                    id="inputPassword"
                                    placeholder="Password"
                                />
                            </div>
                            <div class="form-group">
                                <label for="inputBirthday">Date</label>
                                <input
                                    type="date"
                                    name="inputBirthday"
                                    id="inputBirthday"
                                    placeholder="Date"
                                />
                            </div>
                            <button type="submit" id="btn-signup">Submit</button>
                        </form>
                    </div>
                    <div class="signup-footer">
                        Already have an acoout? Sign in
                        <a href="./signin.php">here</a>
                    </div>
                </div>
            </div>
        </article>
    </main>
<?php endblock() ?>

<?php startblock('another_js') ?>
    <!-- Process Sign Up -->
    <script src="../dist/js/signup.js"></script>
<?php endblock() ?>
