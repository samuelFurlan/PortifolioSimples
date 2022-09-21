<?php $v->layout("_theme"); ?>
    <div class="page-heading">
        <h3>Compras</h3>
    </div>
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Nova Compra</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="post" action="<?= url("compras/salvar-nova-compra") ?>"
                                  id="new-purchase-form"
                                  enctype="multipart/form-data">
                                <input type="hidden" name="compra_id" id="compra_id">
                                <div class="row">
                                    <div class="col-md-6  col-12 mt-2">
                                        <div class="form-group">
                                            <label for="request">Vincular com pedido?</label>
                                            <input type="number" id="request" class="form-control"
                                                   name="request">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12 mt-2"></div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="category">Categoria</label>
                                            <select class="form-select category" id="category" name="category" required>
                                                <option value="">Escolha uma categoria</option>
                                                <?php
                                                if (!empty($category)):
                                                    foreach ($category as $item):
                                                        ?>
                                                        <option value="<?= $item->category_id ?>"><?= $item->category_name ?></option>
                                                    <?php
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
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12 mt-2">
                                        <div class="form-group">
                                            <label for="status">Situação</label>
                                            <select name="status" id="status" class="form-select" required>
                                                <option value="">Escolha uma situação</option>
                                                <option value="1">Aguardando Fornecedor</option>
                                                <option value="2">Em transporte</option>
                                                <option value="3">Entregue</option>
                                                <option value="4">Cancelado</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6  col-12 mt-2">
                                        <div class="form-group">
                                            <label for="purchase_date">Data de compra</label>
                                            <input type="date" id="purchase_date" class="form-control"
                                                   name="purchase_date" value="<?php echo date("Y-m-d"); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6  col-12 mt-2">
                                        <div class="form-group">
                                            <label for="delivery_date">Estimativa de entrega</label>
                                            <input type="date" id="delivery_date" class="form-control"
                                                   name="delivery_date">
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
                                            <label for="item">Item <i class="fal fa-plus-circle" data-bs-toggle="modal"
                                                                      data-bs-target="#new-item-modal"></i></label>
                                            <select name="item" id="item" class="form-select">
                                                <option value="">Selecione uma Categoria</option>
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
                                                    <th style="display: none">ID</th>
                                                    <th scope="col">Item</th>
                                                    <th scope="col">Qtde.</th>
                                                    <th scope="col">Valor Unit.</th>
                                                    <th scope="col">Valor Total</th>
                                                    <th scope="col">Remover</th>
                                                </tr>
                                                </thead>
                                                <tbody>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="new-item-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Novo Produto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <section id="multiple-column-form">
                        <div class="row match-height">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <form class="form" method="post"
                                                  action="/almoxarifado/salvar-produto-almoxarifado"
                                                  id="new-warehouse-form"
                                                  enctype="multipart/form-data">
                                                <input type="hidden" id="almoxarifado_id" name="almoxarifado_id">
                                                <div class="row">
                                                    <div class="col-md-4 col-12">
                                                        <div class="form-group">
                                                            <label for="code">Código de estoque</label>
                                                            <input type="text" id="code" class="form-control"
                                                                   name="code" placeholder="Código">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 col-12"></div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="category">Categoria
                                                                <i class="fal fa-plus-circle" data-bs-toggle="modal"
                                                                   data-bs-target="#link-request-modal"></i>
                                                            </label>
                                                            <select class="form-select category" id="category"
                                                                    name="category" required>
                                                                <option value="">Escolha uma categoria</option>
                                                                <?php
                                                                if (!empty($category)):
                                                                    foreach ($category as $cat):
                                                                        ?>
                                                                        <option value="<?= $cat->category_id ?>"><?= $cat->category_name ?></option>
                                                                    <?php
                                                                    endforeach;
                                                                endif;
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="product">Produto</label>
                                                            <input type="text" id="product" class="form-control"
                                                                   name="product" placeholder="Produto" maxlength="250"
                                                                   required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="fabricante">Fabricante</label>
                                                            <input type="text" id="fabricante" class="form-control"
                                                                   name="fabricante" placeholder="Fabricante">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="modelo">Modelo</label>
                                                            <input type="text" id="modelo" class="form-control"
                                                                   name="modelo" placeholder="Modelo">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="tipo">Tipo Unidade
                                                                <i class="fal fa-plus-circle" data-bs-toggle="modal"
                                                                   data-bs-target="#link-unit-modal"></i>
                                                            </label>
                                                            <select class="form-select" id="tipo" name="tipo" required>
                                                                <?php
                                                                if (!empty($unity)):
                                                                    foreach ($unity as $item):
                                                                        ?>
                                                                        <option value="<?= $item->unity_id ?>"><?= $item->unity_name ?></option>
                                                                    <?php
                                                                    endforeach;
                                                                endif;
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-12">
                                                        <div class="form-group">
                                                            <label for="estoqueMin">Estoque Min.</label>
                                                            <input type="number" id="estoqueMin" class="form-control"
                                                                   name="estoqueMin" placeholder="Min." required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-12">
                                                        <div class="form-group">
                                                            <label for="estoqueMax">Estoque atual</label>
                                                            <input type="number" id="estoqueMax" class="form-control"
                                                                   name="estoqueMax" placeholder="Atual" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-12"></div>
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <div class="checkbox">
                                                                <input type="checkbox" name="warehouse_control"
                                                                       id="warehouse_control" class="form-check-input"
                                                                       value="1">
                                                                <label for="warehouse_control">Controlar Estoque</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <div class="checkbox">
                                                                <input type="checkbox" name="ferramentaria_control"
                                                                       id="ferramentaria_control"
                                                                       class="form-check-input" value="1">
                                                                <label for="ferramentaria_control">Controlado pela
                                                                    ferramentaria</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mt-4 d-flex justify-content-end">
                                                        <button type="reset" onclick="$('#almoxarifado_id').val('');"
                                                                id="btn-reset-warehouse"
                                                                class="btn btn-light-secondary me-1 mb-1">Limpar
                                                        </button>
                                                        <button type="submit" id="button-submit"
                                                                class="btn btn-primary me-1 mb-1">
                                                            Salvar
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Modal -->
                    <div class="modal fade" id="link-request-modal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <form class="form" method="post"
                                                  action="/compras/adicionar-categoria-fornecedor"
                                                  id="new-category-form"
                                                  enctype="multipart/form-data">
                                                <input type="hidden" id="id_category" name="id_category">
                                                <div class="row">
                                                    <div class="col-9">
                                                        <div class="form-group">
                                                            <label for="categoryName">Adicionar Categoria</label>
                                                            <input type="text" id="categoryName" class="form-control"
                                                                   name="categoryName" maxlength="250" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-3 mt-4">
                                                        <button type="submit" id="category-submit"
                                                                class="btn btn-primary me-1 mb-1">Salvar
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="link-unit-modal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <form class="form" method="post" action="/almoxarifado/adicionar-unidade"
                                                  id="unity-form"
                                                  enctype="multipart/form-data">
                                                <input type="hidden" id="unidade_id" name="unidade_id">
                                                <div class="row">
                                                    <div class="col-9">
                                                        <div class="form-group">
                                                            <label for="unidade">Adicionar Unidade</label>
                                                            <input type="text" id="unidade" class="form-control"
                                                                   name="unidade" maxlength="250" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-3 mt-4">
                                                        <button type="submit" id="unity-submit"
                                                                class="btn btn-primary me-1 mb-1">Salvar
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php $v->start("scripts"); ?>
                    <script src="<?= url_views("panel/_js/warehouse_control.js"); ?>"></script>
                    <?php $v->end(); ?>
                </div>
            </div>
        </div>
    </div>
<?php $v->start("scripts"); ?>
    <script src="<?= url_views("panel/_js/new_purchase.js"); ?>"></script>
<?php $v->end(); ?>