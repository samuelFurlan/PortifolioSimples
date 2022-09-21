<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= url("themes/_assets/_css/bootstrap.css"); ?>">
    <link rel="stylesheet" href="<?= url("themes/_assets/_css/app.css"); ?>">

    <link rel="stylesheet" href="<?= url("themes/_assets/_vendors/perfect-scrollbar/perfect-scrollbar.css"); ?>">
    <link rel="stylesheet" href="<?= url("themes/_assets/_vendors/bootstrap-icons/bootstrap-icons.css"); ?>">
    <link rel="stylesheet" href="<?= url("themes/_assets/_vendors/DataTables/datatables.css"); ?>">
    <link rel="stylesheet" href="<?= url("themes/_assets/_vendors/toastify/toastify.css"); ?>">
    <link rel="stylesheet" href="<?= url("themes/_assets/_vendors/sweetalert2/sweetalert2.min.css"); ?>">
    <link rel="stylesheet" href="<?= url("themes/_assets/_vendors/daterangepicker/daterangepicker.css"); ?>"/>
    <link rel="stylesheet" href="<?= url("themes/_assets/_vendors/pretty-checkbox/pretty-checkbox.min.css"); ?>"/>
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css"/>

    <link rel="shortcut icon" href="<?= url("themes/_assets/_images/logos/favicon.png"); ?>" type="image/x-icon">
    <?= $v->section("styles"); ?>
</head>
<body>
<div id="app">
    <!-- Insert Sidebar   -->
    <?php $v->insert('_sidebar') ?>
    <!-- End Sidebar   -->
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
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
                    <p>2021 &copy; Sepia</p>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="<?= url("themes/_assets/_vendors/perfect-scrollbar/perfect-scrollbar.min.js"); ?>"></script>
<script src="<?= url("themes/_assets/_js/bootstrap.bundle.min.js"); ?>"></script>
<script src="<?= url("themes/_assets/_js/sidebar.js"); ?>"></script>
<script src="<?= url("themes/_assets/_vendors/jquery/jquery.js"); ?>"></script>
<script src="<?= url("themes/_assets/_vendors/DataTables/datatables.js"); ?>"></script>
<script src="<?= url("themes/_assets/_vendors/toastify/toastify.js"); ?>"></script>
<script src="<?= url("themes/_assets/_vendors/sweetalert2/sweetalert2.all.min.js"); ?>"></script>
<script src="<?= url("themes/_assets/_vendors/daterangepicker/moment.min.js"); ?>"></script>
<script src="<?= url("themes/_assets/_vendors/daterangepicker/daterangepicker.min.js"); ?>"></script>

<?= $v->section("scripts"); ?>
<script src="<?= url("themes/client/assets/js/index.js"); ?>"></script>
</body>
</html>