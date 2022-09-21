<?php $v->layout("_theme"); ?>
<section class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Compras</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <!-- Table with outer spacing -->
                            <div class="table-responsive">
                                <table class="table" id="tableHome">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Data Pedido</th>
                                        <th>Fornecedor</th>
                                        <th>Estimativa</th>
                                        <th>Orçamento</th>
                                        <th>Status</th>
                                        <th>Visualizar</th>
                                        <th>Editar</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if (!empty($purchase)):
                                        foreach ($purchase as $item):
                                            switch ($item->purchase_status) {
                                                case 1:
                                                    $status = "Aguardando Fornecedor <i class='fa fa-circle' style='color: yellow;'></i>";
                                                    $editar = "<a href='" . url("compras/compra/") . $item->purchase_id . "'><i class='fa fa-pen'></i></a>";
                                                    break;
                                                case 2:
                                                    $status = "Em transporte <i class='fa fa-circle' style='color: yellow;'></i>";
                                                    $editar = "<a href='" . url("compras/compra/") . $item->purchase_id . "'><i class='fa fa-pen'></i></a>";
                                                    break;
                                                case 3:
                                                    $status = "Entregue <i class='fa fa-circle' style='color: green;'></i>";
                                                    $editar = "";
                                                    break;
                                                case 4:
                                                    $status = "Cancelado <i class='fa fa-circle' style='color: red;'></i>";
                                                    $editar = "";
                                                    break;
                                            }
                                            if ($item->purchase_estimate != "") {
                                                $estimated = date("d/m/Y", strtotime($item->purchase_estimate));
                                            } else {
                                                $estimated = "A Combinar";
                                            }
                                            if ($item->purchase_budget != "") {

                                                $budget = "<i class='fal fa-external-link' style='cursor: pointer;' 
                                                                onclick='viewBudget({$item->purchase_id})'></i>";;
                                            } else {
                                                $budget = "";
                                            }
                                            ?>
                                            <tr>
                                                <td><?= $item->purchase_id ?></td>
                                                <td><?= date("d/m/Y", strtotime($item->purchase_date)) ?></td>
                                                <td><?= $item->providerName()->providerName ?></td>
                                                <td><?= $estimated ?></td>
                                                <td><?= $budget ?></td>
                                                <td><?= $status ?></td>
                                                <td>
                                                    <a href="<?php echo url("compras/imprimir-compra/") . $item->purchase_id ?>"
                                                       target="_blank"><i class="fal fa-print"></i> </a></td>
                                                <td><?= $editar ?></td>
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
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="budget-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Orçamentos Enviados</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-content">
                    <div class="card-body">
                        <ul id="budget-list">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $v->start("scripts"); ?>
<script src="<?= url_views("panel/_js/purchase_status.js"); ?>"></script>
<?php $v->end(); ?>
