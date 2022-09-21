<?php $v->layout("_theme_client"); ?>
    <section class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Próximos anúncios </h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="card-body py-4 px-5">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-xl">
                                                    <img id="previewImage" src="<?= url($client["previewImage"]); ?>">
                                                </div>
                                                <div class="ms-3 name">
                                                    <h5 class="font-bold"><?= $client["clientName"] ?></h5>
                                                    <h6 class="text-muted mb-0">@<?= $client["userClient"] ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label for="dateRange">Buscar por datas</label>
                                            <input class="form-control" type="text" id="dateRange"/>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6 mt-2">
                                            <div class="form-check">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="form-check-input form-check-info"
                                                           id="showCopy">
                                                    <label class="form-check-label" for="showCopy">Mostrar Copys</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6 mt-2">
                                            <div class="form-check">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="form-check-input form-check-danger"
                                                           id="copyEdit">
                                                    <label class="form-check-label" for="copyEdit">Mostrar copys
                                                        editadas</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row" id="divPrincipal"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--large size Modal -->
    <div class="modal fade text-left" id="publication" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-7">
                            <img src="<?= url("themes/_assets/_images/defaults/default-avatar.jpg"); ?>"
                                 class="d-block w-100">
                        </div>
                        <div class="col-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex">
                                        <div class="avatar avatar-md">
                                            <img id="previewImage" src="<?= url($client["previewImage"]); ?>">
                                        </div>
                                        <div class="ms-3 mt-2 name">
                                            <h6 class="text-muted mb-0">@<?= $client["userClient"] ?></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <hr>
                                </div>
                                <div class="col-12 overflow-auto" style="max-height: 300px;">
                                    <h6>Copy Insta <i class="bi bi-pen-fill"></i></h6>
                                    <div class="d-flex">
                                        <div class="avatar avatar-md">
                                            <img id="previewImage" src="<?= url($client["previewImage"]); ?>">
                                        </div>
                                        <div class="ms-3 mt-2 name">
                                            <h6 class="text-muted mb-0">@<?= $client["userClient"] ?></h6>
                                            <p>
                                                Ser amigo é se preocupar, querer o bem, estar próximo. Ser amigo é fazer
                                                de tudo para acabar com a sua fome. Reúna seus melhores amigos,
                                                lembre-se sempre do quanto os ama e faça o seu pedido em nosso delivery,
                                                amigão!

                                                📍 Unidade I: (15) 3342-4689
                                                Av. Itavuvu, 2796, Jd. Santa Cecília.
                                                ⠀
                                                📍 Unidade II: (15) 3033-3138
                                                Av. Dr. Armando Pannunzio, 431, Jd. Europa.
                                                ⠀
                                                📍Unidade III: (15) 3221-2760 /// (15) 9 9674-2760 /// (15) 9 9675-2760
                                                Av. Elias Maluf, 713, Wanel Ville.
                                                *Unidades de Sorocaba/SP
                                                ⠀
                                                💻 Acesse o link em nossa bio e peça já!
                                                ⠀
                                                #BarbosaDog #lanche #hotdog #dogao #Deusnocontrole #omelhorlanche
                                                #Sorocaba
                                                2 d
                                            </p>
                                        </div>
                                    </div>
                                    <h6>Copy Face <i class="bi bi-pen-fill"></i></h6>
                                    <div class="d-flex">
                                        <div class="avatar avatar-md">
                                            <img id="previewImage" src="<?= url($client["previewImage"]); ?>">
                                        </div>
                                        <div class="ms-3 mt-2 name">
                                            <h6 class="text-muted mb-0">@<?= $client["userClient"] ?></h6>
                                            <p>
                                                Ser amigo é se preocupar, querer o bem, estar próximo. Ser amigo é fazer
                                                de tudo para acabar com a sua fome. Reúna seus melhores amigos,
                                                lembre-se sempre do quanto os ama e faça o seu pedido em nosso delivery,
                                                amigão!

                                                📍 Unidade I: (15) 3342-4689
                                                Av. Itavuvu, 2796, Jd. Santa Cecília.
                                                ⠀
                                                📍 Unidade II: (15) 3033-3138
                                                Av. Dr. Armando Pannunzio, 431, Jd. Europa.
                                                ⠀
                                                📍Unidade III: (15) 3221-2760 /// (15) 9 9674-2760 /// (15) 9 9675-2760
                                                Av. Elias Maluf, 713, Wanel Ville.
                                                *Unidades de Sorocaba/SP
                                                ⠀
                                                💻 Acesse o link em nossa bio e peça já!
                                                ⠀
                                                #BarbosaDog #lanche #hotdog #dogao #Deusnocontrole #omelhorlanche
                                                #Sorocaba
                                                2 d
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="ms-3 mt-2 name">
                                            <h6>Comentários</h6>
                                            <p>Meu comentário novo</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control" rows="3" style="resize: none"
                                              placeholder="Deixei seu comentário...."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!--Modal Xl size -->
<?php $v->start("scripts"); ?>
    <script src="<?= url("themes/client/assets/js/ads.js"); ?>"></script>
<?php $v->end(); ?>