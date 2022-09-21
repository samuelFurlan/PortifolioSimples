<?php $v->layout("_theme"); ?>
    <div class="page-heading">
        <h3>Compras</h3>
    </div>
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Editar Compra</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <?php
                            if (!empty($purchase)):
                                ?>
                                <form class="form" method="post" action="<?= url("compras/salvar-edit-compra") ?>"
                                      id="edit-purchase-form"
                                      enctype="multipart/form-data">
                                    <input type="hidden" name="compra_id" id="compra_id"
                                           value="<?= $purchase->purchase_id ?>">
                                    <div class="row">
                                        <div class="col-md-6  col-12 mt-2">
                                            <div class="form-group">
                                                <label for="request">Vincular com pedido?</label>
                                                <input type="number" id="request" class="form-control"
                                                       value="<?= $purchase->purchase_request ?>" name="request">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 mt-2"></div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="category">Categoria</label>
                                                <select class="form-select" id="category" name="category" required>
                                                    <option value="">Escolha uma categoria</option>
                                                    <?php
                                                    if (!empty($category)):
                                                        foreach ($category as $item):
                                                            if ($item->category_id == $purchase->purchase_fk_category):
                                                                ?>
                                                                <option value="<?= $item->category_id ?>"
                                                                        selected><?= $item->category_name ?></option>
                                                            <?php
                                                            else:
                                                                ?>
                                                                <option value="<?= $item->category_id ?>"><?= $item->category_name ?></option>
                                                            <?php
                                                            endif;
                                                        endforeach;
                                                    endif;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 mt-2">
                                            <div class="form-group">
                                                <label for="provider">Escolha um fornecedor</label>
                                                <select name="provider" id="provider" class="form-select" required>
                                                    <option value="">Escolha um fornecedor</option>
                                                    <?php
                                                    if (!empty($provider)):
                                                        foreach ($provider as $item):
                                                            if ($item->provider_id == $purchase->purchase_fk_provider):
                                                                ?>
                                                                <option value="<?= $item->provider_id ?>"
                                                                        selected><?= $item->provider_name ?></option>
                                                            <?php
                                                            else:
                                                                ?>
                                                                <option value="<?= $item->provider_id ?>"><?= $item->provider_name ?></option>
                                                            <?php
                                                            endif;
                                                        endforeach;
                                                    endif;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 mt-2">
                                            <div class="form-group">
                                                <label for="status">Situação</label>
                                                <select name="status" id="status" class="form-select" required>
                                                    <option value="">Escolha uma situação</option>
                                                    <option value="1" <?= $purchase->purchase_status == 1 ? "selected" : "" ?>>
                                                        Aguardando Fornecedor
                                                    </option>
                                                    <option value="2" <?= $purchase->purchase_status == 2 ? "selected" : "" ?>>
                                                        Em transporte
                                                    </option>
                                                    <option value="3" <?= $purchase->purchase_status == 3 ? "selected" : "" ?>>
                                                        Entregue
                                                    </option>
                                                    <option value="4" <?= $purchase->purchase_status == 4 ? "selected" : "" ?>>
                                                        Cancelado
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6  col-12 mt-2">
                                            <div class="form-group">
                                                <label for="purchase_date">Data de compra</label>
                                                <input type="date" id="purchase_date" class="form-control"
                                                       name="purchase_date"
                                                       value="<?php echo date("Y-m-d", strtotime($purchase->purchase_date)); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6  col-12 mt-2">
                                            <div class="form-group">
                                                <label for="delivery_date">Estimativa de entrega</label>
                                                <input type="date" id="delivery_date" class="form-control"
                                                       name="delivery_date"
                                                       value="<?php echo $purchase->purchase_estimate != "" ? date("Y-m-d", strtotime($purchase->purchase_estimate)) : ""; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6  col-12 mt-2">
                                            <div class="form-group">
                                                <label for="delivery_date">Anexar Orçamento</label>
                                                <input type="file" id="budget" class="form-control" name="budget">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="item">Item</label>
                                                <select name="item" id="item" class="form-select">
                                                    <?php
                                                    if (!empty($products)):
                                                        foreach ($products as $item):
                                                            ?>
                                                            <option value="<?= $item->product_id ?>"><?= $item->product_code . " - " . $item->product_name ?></option>
                                                        <?php
                                                        endforeach;
                                                    endif;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-12">
                                            <div class="form-group">
                                                <label for="qtde">Qtde.</label>
                                                <input type="number" id="qtde" class="form-control"
                                                       name="qtde">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="unitValue">Valor unit.</label>
                                                <input type="text" id="unitValue" class="form-control"
                                                       name="unitValue">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="totalValue">Valor Total.</label>
                                                <input type="text" id="totalValue" class="form-control"
                                                       name="totalValue">
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <i class="fal fa-plus-circle" onclick="addRow()"></i>
                                        </div>
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table table-lg" id="body-table-itens">
                                                    <thead>
                                                    <tr>
                                                        <th style="display: none">IDROW</th>
                                                        <th style="display: none">IDITEM</th>
                                                        <th scope="col">Item</th>
                                                        <th scope="col">Qtde.</th>
                                                        <th scope="col">Valor Unit.</th>
                                                        <th scope="col">Valor Total</th>
                                                        <th scope="col">Remover</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    if (!empty($itens)):
                                                        foreach ($itens as $iten):
                                                            ?>
                                                        <tr>
                                                            <td style="display: none"><?= $iten->itens_purchase_id ?></td>
                                                            <td style="display: none"><?= $iten->itens_purchase_fk_product ?></td>
                                                            <td><?= $iten->itemName()->itemName ?></td>
                                                            <td><?= $iten->itens_purchase_amount ?></td>
                                                            <td><?= $iten->itens_purchase_value_total ?></td>
                                                            <td><?= $iten->itens_purchase_value_total ?></td>
                                                            <td><i onclick="$(this).closest('tr').remove(); removeRow(<?= $iten->itens_purchase_id?>);" class="fal fa-times"></i> </td>
                                                        </tr>
                                                    <?php
                                                        endforeach;
                                                    endif;
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-4 d-flex justify-content-end">
                                            <button type="reset" onclick="$('#employe_id').val('');" id="button-reset"
                                                    class="btn btn-light-secondary me-1 mb-1">Limpar
                                            </button>
                                            <button type="submit" id="button-submit" class="btn btn-primary me-1 mb-1">
                                                Salvar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            <?php
                            else:
                                ?>
                                <h2>Compra não localizada!</h2>
                            <?php
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $v->start("scripts"); ?>
    <script src="<?= url_views("panel/_js/edit_purchase.js"); ?>"></script>
<?php $v->end(); ?>