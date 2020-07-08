<?php
    session_start();

    $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

    // This plugins allows you to connect multiple file
    require_once('../plugins/phpti-master/ti.php');

    include '../includes/all.include.php';

    // Checking if session is set
    if (isset($_SESSION['data'])) {
        $data = $_SESSION['data'];
        $user_id = $_SESSION['data']['id'];
        $user_role = $_SESSION['data']['role'];
        $getAccount = $account->getAccount($user_id, $user_role);
        $user_fullname = $getAccount['fullname'];
        $user_username = $getAccount['username'];
        $user_email = $getAccount['email'];
        $user_password = $getAccount['password'];
        if ($user_role === "patient") {
            $user_age = $getAccount['age'];
            $user_birthday = $getAccount['birthday'];
            $user_address = $getAccount['address'];
            $user_contact_no = $getAccount['contact_no'];
        }
    } else {
        header("Location: ../index.php");
    }

    $getAllRequest = $request->getAllRequest();
    $countRequest = count($getAllRequest);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>QF Searching App</title>
        <link rel="shortcut icon" href="./../dist/img/logo.jpg" type="image/x-icon">
        <!------------------------- CSS FILES ------------------------->
        <!-- Google Fonts -->
        <link
            href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap"
            rel="stylesheet"
        />
        <!-- Font Awesome CDN -->
        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
            integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
            crossorigin="anonymous"
        />
        <!-- Custom Styles -->
        <link rel="stylesheet" href="./../dist/css/styles.min.css" />

        <?php emptyblock('another_css') ?>

        <!------------------------- JS FILES ------------------------->
        <!-- Chart CDN JS -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
        <!-- JQuery CDN -->
        <script
            src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"
        ></script>
        <!-- Sweet Alert2 CDN -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <!-- Sidebar -->
        <script src="../dist/js/sidemenu.js"></script>
    </head>
    <body>
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="header-image">
                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                </div>
                <div class="header-name"><?= $user_fullname; ?></div>
            </div>
            <div class="sidebar-body">
                <ul>
                    <li class="<?= strpos($url, 'pages/dashboard') !== false ? "active" : "" ?>">
                        <a href="dashboard.php">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="<?= strpos($url, 'pages/request') !== false ? "active" : "" ?>">
                        <a href="request.php">
                            <i class="fa fa-wpforms" aria-hidden="true"></i>
                            <span>Quarantine Request</span></a
                        >
                    </li>
                    <li class="<?= strpos($url, 'pages/messages') !== false ? "active" : "" ?>">
                        <a href="messages.php">
                            <i class="fa fa-inbox" aria-hidden="true"></i>
                            <span>Messages 
                            <?php if ($countRequest > 0 && $user_role === "admin") { ?>
                                <small style="background-color: #afc6ce;
                                            border-radius: 10px;
                                            color: black;
                                            height: 10px;
                                            width: 10px;
                                            margin-left: .1rem;
                                            display: inline-block;"></small>
                            <?php } ?>
                            </span>
                        </a>
                    </li>
                    <li class="<?= strpos($url, 'pages/account') !== false ? "active" : "" ?>">
                        <a href="account.php">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span>Account</span></a
                        >
                    </li>
                </ul>
            </div>
            <div class="sidebar-footer">
                <a href="./../index.php" target="_blank"
                    ><i class="fa fa-globe" aria-hidden="true"></i
                    ><span> Visit Website</span></a
                >
            </div>
        </aside>
        <nav class="topbar">
            <div class="topbar-menu" id="topbar-menu">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </div>
            <div class="topbar-logout">
                <a href="logout.php">
                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                    <span>Logout</span>
                </a>
            </div>
        </nav>
        
        <div id="wrapper">
            <?php emptyblock('main_content') ?>
        </div>

        <!-- Use this method to add another script -->
        <?php emptyblock('another_js') ?>
    </body>
</html>
