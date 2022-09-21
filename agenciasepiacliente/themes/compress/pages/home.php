<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= url("themes/_assets/_css/bootstrap.css") ?>">
    <link rel="stylesheet" href="<?= url("themes/_assets/_vendors/bootstrap-icons/bootstrap-icons.css"); ?>">
    <link rel="stylesheet" href="<?= url("themes/_assets/_css/app.css"); ?>">
    <link rel="stylesheet" href="<?= url("themes/compress/assets/css/button.css"); ?>">
    <link rel="stylesheet" href="<?= url("themes/_assets/_vendors/toastify/toastify.css"); ?>">
    <link rel="stylesheet" href="<?= url("themes/_assets/_vendors/fontawsome/css/all.css"); ?>">

    <link rel="shortcut icon" href="<?= url("themes/_assets/_images/logos/favicon.png"); ?>" type="image/x-icon">
</head>

<body>
<nav class="navbar navbar-light">
    <div class="container d-block">
        <a href="<?= url("cliente") ?>"><i class="bi bi-chevron-left"></i></a>
        <a class="navbar-brand ms-4">
            <img src="<?= url("themes/_assets/_images/logos/logo.png"); ?>" alt="Logo"
                 style="height: 2.8rem !important;">
        </a>
    </div>
</nav>
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h4 class="card-title">Redimensionar imagens</h4>
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-12 mb-1">
                    <p>Bem-vindo ao sistema de redimensionamento da Agência Sepia.<br>
                        Os formatos de imagens permitidos são: .jpg, .jpeg, .png e .gif.<br>
                        Cada imagem pode ter no máximo 10Mb<br>
                        O tamanho máximo permitido é 1920 x 1920 Pixels.
                    </p>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <h5>Escolha os valores de saida</h5>
                            </div>
                            <div class="col-12 mb-1">
                                <ul class="list-unstyled mb-0">
                                    <li class="d-inline-block me-2 mb-1">
                                        <div class="form-check">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="form-check-input form-check-primary"
                                                       name="noResize" id="noResize">
                                                <label class="form-check-label" for="noResize">Manter tamanho
                                                    original</label>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div id="divResize">
                                <div class="col-12 mb-1">
                                    <ul class="list-unstyled mb-0">
                                        <li class="d-inline-block me-2 mb-1">
                                            <div class="form-check">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="form-check-input form-check-primary"
                                                           checked name="proportion" id="proportion">
                                                    <label class="form-check-label" for="proportion">Manter
                                                        proporção</label>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 mb-1">
                                    <h6>Largura</h6>
                                    <div class="input-group mb-3">
                                        <input type="text" id="width" name="width" class="form-control">
                                        <span class="input-group-text">Pixels</span>
                                    </div>
                                </div>
                                <div class="col-6"></div>
                                <div class="col-sm-12 col-md-6 col-lg-6  mb-1">
                                    <h6>Altura</h6>
                                    <div class="input-group mb-3">
                                        <input type="text" id="height" name="height" class="form-control">
                                        <span class="input-group-text">Pixels</span>
                                    </div>
                                </div>
                                <div class="col-6"></div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6  mb-1">
                                <h6>Qualidade : <span id="spanValue">70</span>%</h6>
                                <input type="range" class="form-range" id="quality" name="quality"
                                       min="10" max="100" step="1" value="70" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 text-center">
                    <div class="">
                        <h5>Escolha os arquivos</h5>
                        <input type="file" id="archives" name="archives" multiple accept=".jpeg, .jpg, .png, .gif"/>
                        <label for="archives" class="btn-2">
                            <span>Enviar imagens</span>
                        </label>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <ul class="list-group list-group-flush" id="archivesList"></ul>
                </div>
                <div class="col-12">
                    <button type="button" id="sendButton" class="btn btn-outline-primary btn-lg float-end">Enviar
                    </button>
                </div>
                <div class="col-12 text-center mt-3" id="divDownloader" style="display:none;">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
                        <defs>
                            <filter id="gooey">
                                <!-- in="sourceGraphic" -->
                                <feGaussianBlur in="SourceGraphic" stdDeviation="5" result="blur"/>
                                <feColorMatrix in="blur" type="matrix"
                                               values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9"
                                               result="highContrastGraphic"/>
                                <feComposite in="SourceGraphic" in2="highContrastGraphic" operator="atop"/>
                            </filter>
                        </defs>
                    </svg>
                    <a id="downloaderLink">
                        <button id="gooey-button">
                            <i class="fas fa-file-download"></i> Baixar arquivo
                            <span class="bubbles">
                                <span class="bubble"></span>
                                <span class="bubble"></span>
                                <span class="bubble"></span>
                                <span class="bubble"></span>
                                <span class="bubble"></span>
                                <span class="bubble"></span>
                                <span class="bubble"></span>
                                <span class="bubble"></span>
                                <span class="bubble"></span>
                                <span class="bubble"></span>
                            </span>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= url("themes/_assets/_vendors/jquery/jquery.js"); ?>"></script>
<script src="<?= url("themes/_assets/_js/jquery.mask.js"); ?>"></script>
<script src="<?= url("themes/_assets/_vendors/toastify/toastify.js"); ?>"></script>
<script src="<?= url("themes/compress/assets/js/index.js"); ?>"></script>

</body>

</html>