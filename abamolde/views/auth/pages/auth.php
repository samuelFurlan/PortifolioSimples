<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= url_views("assets/_css/google-fonts/google-fonts.css") ?>">
    <link rel="stylesheet" href="<?= url_views("assets/_css/bootstrap.css") ?>">
    <link rel="stylesheet" href="<?= url_views("assets/_css/app.css") ?>">
    <link rel="stylesheet" href="<?= url_views("auth/_css/auth.css") ?>">
    <link rel="stylesheet" href="<?= url_views("assets/vendors/font-awesome-pro/css/all.css") ?>">

    <link rel="shortcut icon" href="<?= url("themes/_assets/_images/logos/favicon.png"); ?>" type="image/x-icon">
</head>
<body>
<div id="auth">
    <div class="row h-100">
        <div class="col-lg-6 offset-lg-3 col-12">
            <div id="auth-left">
                <div class="auth-logo text-center">
                    <img src="<?= url_views("assets/_images/logo_auth.jpg") ?>" alt="Logo">
                </div>
                <form action="<?= url("auth-validation") ?>" method="post" enctype="multipart/form-data"
                      id="form_auth">
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-xl" placeholder="Usuário"
                               id="username" name="username" required>
                        <div class="form-control-icon">
                            <i class="fal fa-user-alt"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control form-control-xl" placeholder="Senha"
                               id="password" name="password" required>
                        <div class="form-control-icon">
                            <i class="fal fa-lock"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <select class="form-control form-control-xl" name="company" id="company" required>
                            <option value="">Selecione a empresa</option>
                            <?php
                            if (!empty($company)):
                                foreach ($company as $item):
                                    ?>
                                    <option value="<?= $item->company_id ?>"><?= $item->company_name ?></option>
                                <?php
                                endforeach;
                            endif;
                            ?>
                        </select>
                        <div class="form-control-icon">
                            <i id="icon_select" class="fal fa-chevron-down"></i>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-2">Acessar</button>
                </form>
                <div id="div_error" class="alert alert-light-danger color-danger mt-4"></div>
            </div>
        </div>
    </div>
</div>
<script src="<?= url_views("assets/vendors/font-awesome-pro/js/pro.js") ?>"></script>
<script src="<?= url_views("assets/_js/jquery.min.js") ?>"></script>
<script src="<?= url_views("auth/_js/auth.js") ?>"></script>
</body>
</html>