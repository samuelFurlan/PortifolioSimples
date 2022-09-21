<?php
if (!empty($ads)):
    foreach ($ads as $ad):
        $diasemana = array('Domingo', 'Segunda-Feira', 'Terça-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado');
        $diasemana_numero = date('w', strtotime($ad->date_ads));
        ?>
        <div class="col-xl-4 col-md-4 col-sm-12">
            <div class="card">
                <small>
                    <?php
                    if ($ad->changeAds()):
                        ?>
                        <i class="bi bi-chat-dots-fill text-danger copyEdited"
                           style="display:none;"></i>
                    <?php
                    endif;
                    ?>
                    <i class="bi bi-calendar-event"></i>
                    <?= date('d/m/Y', strtotime($ad->date_ads)) ?>
                    |
                    <?= $diasemana[$diasemana_numero]; ?> |
                    <?= date('H', strtotime($ad->time_ads)) ?>h

                    <div class="pretty p-icon p-curve p-tada float-end"
                         onclick="changeStatus(<?= $ad->id_ads ?>);">
                        <input type="checkbox" <?= ($ad->status_ads == 2) ? "checked" : "" ?>>
                        <div class="state p-success-o">
                            <i class="icon mdi mdi-check"></i>
                            <label></label>
                        </div>
                    </div>

                </small>
                <div class="card-content" style="cursor:pointer;"
                     onclick="modalPublication(<?= $ad->id_ads ?>);">
                    <?php
                    if (!empty($ad->archives_ads)):
                        $archives = json_decode($ad->archives_ads);
                        if (is_array($archives)):
                            ?>
                            <div id="carousel<?= $ad->id_ads ?>"
                                 class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner"
                                     style="border-radius: 0;">
                                    <div class="carousel-item active">
                                        <img class="img-fluid w-100"
                                             src="<?= url($archives[0]) ?>">
                                    </div>
                                    <?php
                                    for ($i = 0; $i < count($archives); $i++):
                                        ?>
                                        <div class="carousel-item">
                                            <img class="img-fluid w-100"
                                                 src="<?= url($archives[$i]) ?>">
                                        </div>
                                    <?php
                                    endfor;
                                    ?>
                                </div>
                                <a class="carousel-control-prev"
                                   href="#carousel<?= $ad->id_ads ?>"
                                   role="button"
                                   data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon"
                                          aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </a>
                                <a class="carousel-control-next"
                                   href="#carousel<?= $ad->id_ads ?>"
                                   role="button"
                                   data-bs-slide="next">
                                    <span class="carousel-control-next-icon"
                                          aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </a>
                            </div>
                        <?php
                        else:
                            switch ($ad->type_ads):
                                case "Imagem":
                                case "Galeria":
                                    ?>
                                    <img class="img-fluid w-100"
                                         src="<?= url($archives) ?>">
                                    <?php
                                    break;
                                case "Video":
                                case "IGTV":
                                    ?>
                                    <video width="100%" controls>
                                        <source src="<?= url($archives) ?>" type="video/mp4">
                                    </video>
                                    <?php
                                    break;
                            endswitch;
                        endif;
                    else:
                        ?>
                        <img class="img-fluid w-100"
                             src="<?= url("themes/_assets/_images/defaults/upload.webp") ?>">
                    <?php
                    endif;
                    ?>
                </div>
                <div class="card-body divCopy"
                     id="divCopy<?= $ad->id_ads ?>"
                     style="display:none;">
                    <p class="card-text">
                    <h6 class="mb-2">Head da Publicação
                        <button class="btn btn-warning btn-sm float-end"
                                onclick="editCopy(<?= $ad->id_ads ?>)">Alterar
                        </button>
                    </h6>
                    <div id="divCopyHead"><?= nl2br($ad->head_ads) ?></div>
                    </p>
                    <p class="card-text">
                    <h6 class="mb-4">Público alvo</h6>
                    <div id="divTarget"><?= nl2br($ad->target_ads) ?></div>
                    </p>
                    <p class="card-text">
                    <h6 class="mb-4">Link</h6>
                    <div id="divLink"><?= nl2br($ad->link_ads) ?></div>
                    </p>
                    <p class="card-text">
                    <h6 class="mb-4">Copy Instagram</h6>
                    <div id="divCopyInsta"><?= nl2br($ad->copyInsta_ads) ?></div>
                    </p>
                    <p class="card-text">
                    <h6 class="mb-2">Copy Facebook</h6>
                    <div id="divCopyFace"><?= nl2br($ad->copyFace_ads) ?></div>
                    </p>
                    <p class="card-text">
                    <h6 class="mb-4">Copy Google Ads</h6>
                    <div id="divGoogle"><?= nl2br($ad->copyGoogle_ads) ?></div>
                    </p>
                </div>
                <div class="card-body"
                     id="divCopyedit<?= $ad->id_ads ?>"
                     style="display:none;">
                    <p class="card-text">
                    <h6 class="mb-4">Head da Publicação
                        <button class="btn btn-success btn-sm float-end"
                                onclick="saveCopy(<?= $ad->id_ads ?>);">
                            Salvar
                        </button>
                    </h6>
                    <textarea class="form-control"
                              id="head<?= $ad->id_ads ?>"
                              rows="6"><?= $ad->head_ads ?></textarea>
                    </p>
                    <p class="card-text">
                    <h6 class="mb-4">Público alvo</h6>
                    <textarea class="form-control"
                              id="target<?= $ad->id_ads ?>"
                              rows="6"><?= $ad->target_ads ?></textarea>
                    </p>
                    <p class="card-text">
                    <h6 class="mb-4">Link</h6>
                    <textarea class="form-control"
                              id="link<?= $ad->id_ads ?>"
                              rows="6"><?= $ad->link_ads ?></textarea>
                    </p>
                    <p class="card-text">
                    <h6 class="mb-4">Copy Instagram</h6>
                    <textarea class="form-control"
                              id="copyInsta<?= $ad->id_ads ?>"
                              rows="6"><?= $ad->copyInsta_ads ?></textarea>
                    </p>
                    <p class="card-text">
                    <h6 class="mb-2">Copy Facebook</h6>
                    <textarea class="form-control"
                              id="copyFace<?= $ad->id_ads ?>"
                              rows="6"><?= $ad->copyFace_ads ?></textarea>
                    </p>
                    <p class="card-text">
                    <h6 class="mb-2">Copy Google Ads</h6>
                    <textarea class="form-control"
                              id="copyGoogle<?= $ad->id_ads ?>"
                              rows="6"><?= $ad->copyGoogle_ads ?></textarea>
                    </p>
                </div>
            </div>
        </div>
    <?php
    endforeach;
else:
    ?>
    <h3 class="text-center">Ops, parece que não temos próximos anúncios</h3>
<?php
endif;
?>
<script>
    openDiv("showCopy", "divCopy");
    openDiv("copyEdit", "copyEdited");
</script>
