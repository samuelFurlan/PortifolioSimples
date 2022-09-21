<?php
if (!empty($publications)):
    foreach ($publications as $publication):
        $diasemana = array('Domingo', 'Segunda-Feira', 'Terça-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado');
        $diasemana_numero = date('w', strtotime($publication->date_publication));
        ?>
        <div class="col-xl-4 col-md-4 col-sm-12">
            <div class="card">
                <small>
                    <?php
                    if ($publication->changePubli()):
                        ?>
                        <i class="bi bi-chat-dots-fill text-danger copyEdited"
                           style="display:none;"></i>
                    <?php
                    endif;
                    ?>
                    <i class="bi bi-calendar-event"></i>
                    <?= date('d/m/Y', strtotime($publication->date_publication)) ?>
                    |
                    <?= $diasemana[$diasemana_numero]; ?> |
                    <?= date('H', strtotime($publication->time_publication)) ?>h

                    <div class="pretty p-icon p-curve p-tada float-end"
                         onclick="changeStatus(<?= $publication->id_publication ?>);">
                        <input type="checkbox" <?= ($publication->status_publication == 2) ? "checked" : "" ?>>
                        <div class="state p-success-o">
                            <i class="icon mdi mdi-check"></i>
                            <label></label>
                        </div>
                    </div>

                </small>
                <div class="card-content" style="cursor:pointer;"
                     onclick="modalPublication(<?= $publication->id_publication ?>);">
                    <?php
                    if (!empty($publication->archives_publication)):
                        $archives = json_decode($publication->archives_publication);
                        if (is_array($archives)):
                            ?>
                            <div id="carousel<?= $publication->id_publication ?>"
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
                                   href="#carousel<?= $publication->id_publication ?>"
                                   role="button"
                                   data-bs-slide="prev">
                                                                        <span class="carousel-control-prev-icon"
                                                                              aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </a>
                                <a class="carousel-control-next"
                                   href="#carousel<?= $publication->id_publication ?>"
                                   role="button"
                                   data-bs-slide="next">
                                                                        <span class="carousel-control-next-icon"
                                                                              aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </a>
                            </div>
                        <?php
                        else:
                            switch ($publication->type_publication):
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
                     id="divCopy<?= $publication->id_publication ?>"
                     style="display:none;">
                    <p class="card-text">
                    <h6 class="mb-2">Head da Publicação
                        <button class="btn btn-warning btn-sm float-end"
                                onclick="editCopy(<?= $publication->id_publication ?>)">Alterar
                        </button>
                    </h6>
                    <div id="divCopyHead"><?= nl2br($publication->head_publication) ?></div>
                    </p>
                    <p class="card-text">
                    <h6 class="mb-4">Copy Instagram</h6>
                    <div id="divCopyInsta"><?= nl2br($publication->copyInsta_publication) ?></div>
                    </p>
                    <p class="card-text">
                    <h6 class="mb-2">Copy Facebook</h6>
                    <div id="divCopyFace"><?= nl2br($publication->copyFace_publication) ?></div>
                    </p>

                </div>
                <div class="card-body"
                     id="divCopyedit<?= $publication->id_publication ?>"
                     style="display:none;">
                    <p class="card-text">
                    <h6 class="mb-4">Head da Publicação
                        <button class="btn btn-success btn-sm float-end"
                                onclick="saveCopy(<?= $publication->id_publication ?>);">
                            Salvar
                        </button>
                    </h6>
                    <textarea class="form-control"
                              id="head<?= $publication->id_publication ?>"
                              rows="6"><?= $publication->head_publication ?></textarea>
                    </p>
                    <p class="card-text">
                    <h6 class="mb-4">Copy Instagram</h6>
                    <textarea class="form-control"
                              id="copyInsta<?= $publication->id_publication ?>"
                              rows="6"><?= $publication->copyInsta_publication ?></textarea>
                    </p>
                    <p class="card-text">
                    <h6 class="mb-2">Copy Facebook</h6>
                    <textarea class="form-control"
                              id="copyFace<?= $publication->id_publication ?>"
                              rows="6"><?= $publication->copyFace_publication ?></textarea>
                    </p>
                </div>
            </div>
        </div>
    <?php
    endforeach;
else:
    ?>
    <h3 class="text-center">Ops, parece que não temos próximas publicações</h3>
<?php
endif;
?>
<script>
    openDiv("showCopy", "divCopy");
    openDiv("copyEdit", "copyEdited");
</script>
