<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="<?= url_views("assets/_css/google-fonts/google-fonts.css") ?>">
    <link rel="stylesheet" href="<?= url_views("assets/_css/bootstrap.css") ?>">
    <link rel="stylesheet" href="<?= url_views("assets/vendors/perfect-scrollbar/perfect-scrollbar.css") ?>">
    <link rel="stylesheet" href="<?= url_views("assets/_css/app.css") ?>">
    <link rel="stylesheet" href="<?= url_views("assets/vendors/font-awesome-pro/css/all.css") ?>">
    <link rel="stylesheet" href="<?= url_views("assets/vendors/toastify/toastify.css") ?>">
    <link rel="stylesheet" href="<?= url_views("assets/vendors/DataTables/datatables.css") ?>">
    <link rel="stylesheet" href="<?= url_views("assets/vendors/choices.js/choices.min.css") ?>">
    <link rel="stylesheet" href="<?= url_views("assets/vendors/sweetalert2/sweetalert2.min.css") ?>">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <?= $v->section("styles"); ?>
</head>

<body>
<div id="app">
    <!-- Insert Sidebar   -->
    <?php $v->insert('_sidebar') ?>
    <!-- End Sidebar   -->
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block ">
                <i class="fal fa-stream"></i>
            </a>
        </header>
        <div class="page-content">
            <!-- Content -->
            <?= $v->section("content"); ?>
            <!-- Fim content -->
        </div>
        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>2021 &copy; Bueno TI</p>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="<?= url_views("assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js") ?>"></script>
<script src="<?= url_views("assets/_js/bootstrap.bundle.min.js") ?>"></script>

<script src="<?= url_views("assets/_js/jquery.min.js") ?>"></script>
<script src="<?= url_views("assets/vendors/DataTables/datatables.js") ?>"></script>
<script src="<?= url_views("assets/_js/jquery.mask.js") ?>"></script>
<script src="<?= url_views("assets/vendors/toastify/toastify.js") ?>"></script>
<script src="<?= url_views("assets/vendors/sweetalert2/sweetalert2.all.min.js") ?>"></script>
<script src="<?= url_views("assets/_js/table-to-json.min.js") ?>"></script>
<script src="<?= url_views("assets/vendors/choices.js/choices.min.js") ?>"></script>
<script src="<?= url_views("panel/_js/shared.js") ?>"></script>
<?= $v->section("scripts"); ?>
<script src="<?= url_views("assets/_js/main.js") ?>"></script>
</body>

</html>