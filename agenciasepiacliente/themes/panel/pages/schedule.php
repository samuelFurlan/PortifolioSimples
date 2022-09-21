<?php $v->layout("_theme_panel"); ?>
<?php $v->start("styles"); ?>
<link rel="stylesheet" type="text/css"
      href="<?= url("themes/_assets/_vendors/fullcalendar/packages/core/main.css"); ?>"/>
<link rel="stylesheet" type="text/css"
      href="<?= url("themes/_assets/_vendors/fullcalendar/packages/daygrid/main.css"); ?>"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<?php $v->end(); ?>
<div class="page-heading">
    <!-- Basic Vertical form layout section start -->
    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Agenda de publicações</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
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
                            </div>
                                <div id='calendar'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!--large size Modal -->
<div class="modal fade text-left" id="archives" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel17" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
         role="document">
        <a class="modal-control-button" id="previousPublicationButton">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <div class="modal-content">
            <div class="modal-body scrollOff">
                <div class="row">
                    <div class="col-7">
                        <div class="card">
                            <div class="card-body" style="padding: 0;">
                                <div id="previewArchive" class="carousel slide"
                                     data-ride="carousel">
                                    <div class="carousel-inner" id="divCarousel"
                                         style="border-radius: 0 !important;">
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
                    <div class="col-5">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex">
                                    <div class="avatar avatar-md">
                                        <img class="previewImage" src="">
                                    </div>
                                    <div class="ms-3 mt-2 name">
                                        <h6 class="text-muted mb-0 clientUserLabel"></h6>
                                    </div>
                                    <div class="ms-3 mt-2 name">
                                        <a href="" id="linkPublication"><i class="bi bi-pen-fill"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-12 overflow-auto scrollOff" style="max-height: 27em;">
                                <div class="d-flex">
                                    <div class="avatar avatar-md">
                                        <img class="previewImage" src="">
                                    </div>
                                    <div class="ms-3 mt-2 name">
                                        <h6 class="text-muted mb-0 clientUserLabel"></h6>
                                        <p id="copyInsta"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="ms-3 mt-2 name">
                                    <p id="datePost"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="modal-control-button" id="nextPublicationButton">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
        <input type="hidden" id="previousPublicationInput">
        <input type="hidden" id="nextPublicationInput">
    </div>
</div>
<!--Modal Xl size -->
<?php $v->start("scripts"); ?>
<script src='<?= url("themes/_assets/_vendors/fullcalendar/packages/core/main.js"); ?>'></script>
<script src='<?= url("themes/_assets/_vendors/fullcalendar/packages/core/locales-all.js"); ?>'></script>
<script src='<?= url("themes/_assets/_vendors/fullcalendar/packages/interaction/main.js"); ?>'></script>
<script src='<?= url("themes/_assets/_vendors/fullcalendar/packages/daygrid/main.js"); ?>'></script>
<script src="<?= url("themes/panel/assets/js/schedule.js"); ?>"></script>
<?php $v->end(); ?>
