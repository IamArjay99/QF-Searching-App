<?php 
    include '../layouts/layout.php';

    if (isset($_SESSION['data'])) {
        echo "<script>window.location='".(strpos($url, 'pages') !== false ? "" : "pages/")."dashboard.php';</script>";
    }
?>

<?php startblock('another_css') ?>
<?php endblock() ?>

<?php startblock('main_content') ?>
    <main class="signin">
        <article>
            <h2 class="page-title"></h2>
            <div class="signin-content">
                <div class="signin-box">
                    <div class="signin-header">Sign In</div>
                    <div class="signin-body">
                        <form method="post" id="signin-form" action="dashboard.php">
                            <div class="alert text-danger" id="error-feedback" style="display: none"></div>
                            <div class="form-group">
                                <label for="inputEmail">Email Address</label>
                                <input
                                    type="email"
                                    name="inputEmail"
                                    id="inputEmail"
                                    placeholder="Email Address"
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
                            <button type="submit" id="btn-signin">Submit</button>
                        </form>
                    </div>
                    <div class="signin-footer">
                        Don't have an account yet? Sign up
                        <a href="./signup.php">here</a>
                    </div>
                </div>
            </div>
        </article>
    </main>
<?php endblock() ?>

<?php startblock('another_js') ?>
    <!-- Process Signin -->
    <script src="../dist/js/signin.js"></script>
<?php endblock() ?>
