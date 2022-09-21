<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= url("themes/_assets/_css/bootstrap.css"); ?>">
    <link rel="stylesheet" href="<?= url("themes/_assets/_css/app.css"); ?>">
    <link rel="stylesheet" href="<?= url("themes/_assets/_vendors/bootstrap-icons/bootstrap-icons.css"); ?>">
    <link rel="stylesheet" href="<?= url("themes/auth/assets/css/auth.css"); ?>">

    <link rel="shortcut icon" href="<?= url("themes/_assets/_images/logos/favicon.png"); ?>" type="image/x-icon">
</head>
<body>
<div id="auth">
    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <div class="auth-logo">
                    <a><img src="<?= url("themes/_assets/_images/logos/logo.png"); ?>" alt="Logo"></a>
                </div>
                <h1 class="auth-title">Acessar.</h1>
                <div id="errorDiv" class="alert alert-light-danger color-danger mb-4">
                </div>
                <form method="post" id="auth-forms" action="<?= url("auth-validation") ?>"
                      enctype="multipart/form-data">
                    <div id="authToken">
                        <input id="authTokenInput" type="hidden" name="" value=""/>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" name="user" class="form-control form-control-xl" placeholder="Usuário"
                               required>
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" name="password" class="form-control form-control-xl" placeholder="Senha"
                               required>
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-2">Acessar</button>
                </form>
            </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block">
            <div id="auth-right"></div>
        </div>
    </div>

</div>
<!--Scrips Padrão-->
<script src="<?= url("themes/_assets/_vendors/jquery/jquery.js"); ?>"></script>
<script src="<?= url("themes/auth/assets/js/auth.js"); ?>"></script>
<!--Fim Scrips Padrão-->
</body>
</html>