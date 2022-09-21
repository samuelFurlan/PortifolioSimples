<?php $v->layout("_theme"); ?>
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Ferramentaria Atual</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-lg" id="table-warehouse">
                                    <thead>
                                    <tr>
                                        <th scope="col">N° Série</th>
                                        <th scope="col">Item</th>
                                        <th scope="col">Alocação</th>
                                        <th scope="col">Estado Atual</th>
                                        <th scope="col">Data Retirada</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Observações</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if (!empty($tooling)):
                                        foreach ($tooling as $product):
                                            if ($product->tooling_status == 1) :
                                                $tooling = "Disponível";
                                                $date = "-";
                                            else:
                                                $tooling = "Em uso";
                                                $date = date("d/m/Y", strtotime($product->removeDate()->removeDate))." - ".$product->employeeName()->employeeName;
                                            endif;
                                            $observation = "-";
                                            if (!empty($product->observation()->observation)):
                                                $observation = "<i class='fal fa-eye' style='cursor:pointer;' onclick='openObservation(".$product->tooling_id.")'></i>";
                                            endif;
                                            ?>
                                            <tr>
                                                <td><i style="cursor: pointer" class="fal fa-print" onclick="GerarCdigoDeBarras('<?= $product->tooling_serial ?>')"></i> <?= $product->tooling_serial ?></td>
                                                <td><?= $product->productName()->productName ?></td>
                                                <td><?= $product->product_alocation ?></td>
                                                <td><?= $product->tooling_usage ?>%</td>
                                                <td><?= $date ?></td>
                                                <td><?= $tooling ?></td>
                                                <td><?= $observation ?></td>
                                            </tr>
                                        <?php
                                        endforeach;
                                    endif;
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="link-open-observation" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row" id="observationBody">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="link-open-barcode" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <img id="barcode"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $v->start("scripts"); ?>
    <script src="<?= url_views("panel/_js/JsBarcode.all.min.js") ?>"></script>
    <script src="<?= url_views("panel/_js/tooling_control.js"); ?>"></script>

<?php $v->end(); ?>