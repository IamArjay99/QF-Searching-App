<?php 
    include '../layouts/layout.php';
?>

<?php startblock('another_css') ?>
<?php endblock() ?>

<?php startblock('main_content') ?>
    <main class="news">
        <article>
            <h2 class="page-title">Today's News</h2>
            <div class="row" id="row"></div>
        </article>
    </main>
<?php endblock() ?>

<?php startblock('another_js') ?>
    <!-- News JS -->
    <script src="../dist/js/news.js"></script>
<?php endblock() ?>
