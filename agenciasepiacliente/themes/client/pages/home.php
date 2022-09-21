<?php $v->layout("_theme_client"); ?>
<?php $v->start("styles"); ?>
    <link rel="stylesheet" href="<?= url("themes/client/assets/css/chatbox.css"); ?>"/>
<?php $v->end(); ?>
    <div class="page-heading">
        <h3>Bem-vindo <?= $_SESSION[md5("USERNAME")] ?></h3>
    </div>
    <section class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Próximas publicações </h4>
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
    <div class="container">
        <div class="row">
            <div id="Smallchat">
                <div class="Layout Layout-open Layout-expand Layout-right"
                     style="background-color: #5900b2;color: rgb(255, 255, 255);opacity: 5;border-radius: 10px;">
                    <div class="Messenger_messenger">
                        <div class="Messenger_header"
                             style="background-color: rgb(89,0,178); color: rgb(255, 255, 255);">
                            <h4 class="Messenger_prompt">Qual a sua dúvida?</h4> <span class="chat_close_icon"><i
                                        class="bi bi-x-circle-fill" aria-hidden="true"></i></span></div>
                        <div class="Messenger_content">
                            <div class="Messages">
                                <div class="Messages_list">
                                    <div class="text-center information">Atendimento: <br/> Segunda a Sexta das 9h - 18h
                                        <br> Responderemos o mais rápido possível!
                                    </div>
                                </div>
                            </div>
                            <div class="Input Input-blank">
                                <textarea class="Input_field" placeholder="Envie uma mensagem..."
                                          style="height: 20px;"></textarea>
                                <button class="Input_button Input_button-send">
                                    <div class="Icon" style="width: 18px; height: 18px;">
                                        <svg width="57px" height="54px" viewBox="1496 193 57 54" version="1.1"
                                             xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink"
                                             style="width: 18px; height: 18px;">
                                            <g id="Group-9-Copy-3" stroke="none" stroke-width="1" fill="none"
                                               fill-rule="evenodd"
                                               transform="translate(1523.000000, 220.000000) rotate(-270.000000) translate(-1523.000000, -220.000000) translate(1499.000000, 193.000000)">
                                                <path d="M5.42994667,44.5306122 L16.5955554,44.5306122 L21.049938,20.423658 C21.6518463,17.1661523 26.3121212,17.1441362 26.9447801,20.3958097 L31.6405465,44.5306122 L42.5313185,44.5306122 L23.9806326,7.0871633 L5.42994667,44.5306122 Z M22.0420732,48.0757124 C21.779222,49.4982538 20.5386331,50.5306122 19.0920112,50.5306122 L1.59009899,50.5306122 C-1.20169244,50.5306122 -2.87079654,47.7697069 -1.64625638,45.2980459 L20.8461928,-0.101616237 C22.1967178,-2.8275701 25.7710778,-2.81438868 27.1150723,-0.101616237 L49.6075215,45.2980459 C50.8414042,47.7885641 49.1422456,50.5306122 46.3613062,50.5306122 L29.1679835,50.5306122 C27.7320366,50.5306122 26.4974445,49.5130766 26.2232033,48.1035608 L24.0760553,37.0678766 L22.0420732,48.0757124 Z"
                                                      id="sendicon" fill="#96AAB4" fill-rule="nonzero"></path>
                                            </g>
                                        </svg>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--===============CHAT ON BUTTON STRART===============-->
                <div class="chat_on">
                    <span class="chat_on_icon">
                        <i class="bi bi-chat-dots-fill" aria-hidden="true"></i>
                    </span>
                </div>
                <!--===============CHAT ON BUTTON END===============-->
            </div>
        </div>
    </div>
    <!--large size Modal -->
    <div class="modal fade text-left" id="publication" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-7">
                            <img src="<?= url("themes/_assets/_images/defaults/default-avatar.jpg"); ?>"
                                 class="d-block w-100"
                                 alt="...">
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
    <script src="<?= url("themes/client/assets/js/home.js"); ?>"></script>
<?php $v->end(); ?>