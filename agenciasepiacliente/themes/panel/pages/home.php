<?php $v->layout("_theme_panel"); ?>
    <div class="page-heading">
        <h3>Início</h3>
    </div>
    <section class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Próximas publicações</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <!-- Table with outer spacing -->
                                <div class="table-responsive">
                                    <table class="table" id="tableHome">
                                        <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th>Tipo</th>
                                            <th>Arquivo</th>
                                            <th>Cliente</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--large size Modal -->
    <div class="modal fade text-left" id="archives" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel17" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
             role="document">
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
        </div>
    </div>
    <!--Modal Xl size -->
<?php $v->start("scripts"); ?>
    <script src="<?= url("themes/panel/assets/js/home.js"); ?>"></script>
<?php $v->end(); ?>