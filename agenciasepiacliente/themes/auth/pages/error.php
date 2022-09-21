<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= url("themes/_assets/_css/bootstrap.css"); ?>">
    <link rel="stylesheet" href="<?= url("themes/_assets/_css/error.css"); ?>">

    <link rel="shortcut icon" href="<?= url("themes/_assets/_images/logos/favicon.png"); ?>" type="image/x-icon">
</head>
<body>
<div id="error">
    <div class="error-page container">
        <div class="col-md-8 col-12 offset-md-2">
            <div class="text-center">
                <h1 class="error-title">Página não encontrada</h1>
                <a href="javascript:history.back()" class="btn btn-lg btn-outline-primary mt-3">Voltar</a>
            </div>
            <img class="img-error" src="<?= url("themes/_assets/_images/defaults/error-404.png"); ?>" alt="Not Found">
        </div>
    </div>
</div>
</body>
</html>