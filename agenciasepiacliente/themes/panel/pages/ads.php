<?php $v->layout("_theme_panel"); ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Anúncios</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= url("painel/inicio"); ?>">Início</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Anúncios</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Basic Vertical form layout section start -->
    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Cadastrar Anúncios</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" method="post" id="ads-forms"
                                  action="<?= url("painel/salvar-anuncios") ?>"
                                  enctype="multipart/form-data">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <select class="form-select" id="selectClient"
                                                        name="selectClient">
                                                    <option value="">Escolha o cliente</option>
                                                    <?php foreach ($clients as $client):
                                                        ?>
                                                        <option value="<?= $client->id_clients ?>"><?= $client->name_clients ?></option>
                                                    <?php
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="w-100 d-none d-md-block"></div>
                                        <div class="col-3">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="datePost">Data da postagem</label>
                                                    <input type="date" id="datePost"
                                                           class="form-control" name="datePost"
                                                           placeholder="Nome do produto">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="timePost">Hora da postagem</label>
                                                    <input type="time" id="timePost"
                                                           class="form-control" name="timePost" value="09:00"
                                                           placeholder="Nome do produto">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="typePost">Tipo de postagem</label>
                                                    <select class="form-select" name="typePost" id="typePost"
                                                            required>
                                                        <option value="Imagem">Imagem</option>
                                                        <option value="Galeria">Galeria</option>
                                                        <option value="Video">Video</option>
                                                        <option value="IGTV">IGTV</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="headPost">Head (Arte)</label>
                                                    <textarea class="form-control" name="headPost" id="headPost"
                                                              rows="5"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="target">Público</label>
                                                    <textarea class="form-control" name="target" id="target"
                                                              rows="5"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="linkAds">Link</label>
                                                    <input type="url" class="form-control" id="linkAds" name="linkAds">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <h5 class="card-title">Post principal:</h5>
                                                                <div id="previewArchive" class="carousel slide"
                                                                     data-ride="carousel">
                                                                    <div class="carousel-inner" id="divCarousel"
                                                                         onclick="$('#archive').click();"
                                                                         style="cursor:pointer;">
                                                                        <div class="carousel-item active">
                                                                            <img src="<?= url("themes/_assets/_images/defaults/upload.webp"); ?>"
                                                                                 class="d-block w-100">
                                                                        </div>
                                                                    </div>
                                                                    <div id="controlSlide"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <h5 class="card-title">Outros arquivos:</h5>
                                                                <div id="previewOthersArchive" class="carousel slide"
                                                                     data-ride="carousel">
                                                                    <div class="carousel-inner" id="divCarouselOthers"
                                                                         onclick="$('#othersArchive').click();"
                                                                         style="cursor:pointer;">
                                                                        <div class="carousel-item active">
                                                                            <img src="<?= url("themes/_assets/_images/defaults/upload.webp"); ?>"
                                                                                 class="d-block w-100">
                                                                        </div>
                                                                    </div>
                                                                    <div id="controlSlideOthers"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-6">
                                                    <div class="card-content">
                                                        <div class="card-body py-4 px-5">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar avatar-md">
                                                                    <img id="previewImage"
                                                                         src="<?= url("themes/_assets/_images/defaults/default-avatar.jpg"); ?>"
                                                                         alt="Logo Cliente">
                                                                </div>
                                                                <div class="ms-3 name">
                                                                    <h5 class="font-bold" id="clientNameLabel">
                                                                        Cliente</h5>
                                                                    <h6 class="text-muted mb-0"
                                                                        id="clientUserLabel">
                                                                        Usuário</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="col-12 mb-3">
                                                        <label for="copyInsta">Copyright Instagram</label>
                                                        <textarea class="form-control" name="copyInsta" id="copyInsta"
                                                                  rows="3"></textarea>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <label for="copyFace">Copyright Facebook</label>
                                                        <textarea class="form-control" name="copyFace" id="copyFace"
                                                                  rows="3"></textarea>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <label for="copyGoogle">Copyright Google Ads</label>
                                                        <textarea class="form-control" name="copyGoogle" id="copyGoogle"
                                                                  rows="3"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="file" id="archive" accept="image/*"
                                               style="display: none" name="archive[]">
                                        <input type="file" id="othersArchive" accept="image/*"
                                               style="display: none" name="othersArchive[]">
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="reset" id="btnReset"
                                                    class="btn btn-light-secondary me-1 mb-1">Limpar
                                            </button>
                                            <button type="submit" id="btnSubmit"
                                                    class="btn btn-primary me-1 mb-1">Adicionar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Próximos Anúncios</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row" id="nextAds">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $v->start("scripts"); ?>
<script src="<?= url("themes/panel/assets/js/posts.js"); ?>"></script>
<script src="<?= url("themes/panel/assets/js/ads.js"); ?>"></script>
<?php $v->end(); ?>
