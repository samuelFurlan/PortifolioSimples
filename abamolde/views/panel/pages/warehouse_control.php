<?php $v->layout("_theme"); ?>
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Novo Produto</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="post" action="/almoxarifado/salvar-produto-almoxarifado"
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
                                                <i class="fal fa-plus-circle" data-bs-toggle="modal" data-bs-target="#link-request-modal"></i>
                                            </label>
                                            <select class="form-select"  id="category" name="category" required>
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
                                                   name="product" placeholder="Produto" maxlength="250" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="alocation">Alocação</label>
                                            <input type="text" id="alocation" class="form-control"
                                                   name="alocation" placeholder="Alocação" maxlength="250" required>
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
                                                   name="modelo" placeholder="Modelo" >
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="tipo">Tipo Unidade
                                                <i class="fal fa-plus-circle" data-bs-toggle="modal" data-bs-target="#link-unit-modal"></i>
                                            </label>
                                            <select class="form-select"  id="tipo" name="tipo" required>
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
                                                <input type="checkbox" name="warehouse_control" id="warehouse_control" class="form-check-input" value="1">
                                                <label for="warehouse_control">Controlar Estoque</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check">
                                            <div class="checkbox">
                                                <input type="checkbox" name="ferramentaria_control" id="ferramentaria_control" class="form-check-input" value="1" >
                                                <label for="ferramentaria_control">Controlado pela ferramentaria</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4 d-flex justify-content-end">
                                        <button type="reset" onclick="$('#almoxarifado_id').val('');" id="btn-reset" class="btn btn-light-secondary me-1 mb-1">Limpar</button>
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
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Estoque Atual</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-lg" id="table-warehouse">
                                    <thead>
                                    <tr>
                                        <th scope="col">Código</th>
                                        <th scope="col">Item</th>
                                        <th scope="col">Categoria</th>
                                        <th scope="col">Qtde. Atual</th>
                                        <th scope="col">Min.</th>
                                        <th scope="col">Modelo</th>
                                        <th scope="col">Alocação</th>
                                        <th scope="col">Editar</th>
                                        <th scope="col">Ativo</th>
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
    </section>
    <!-- Modal -->
    <div class="modal fade" id="link-request-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Categorias</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="post" action="/compras/adicionar-categoria-fornecedor" id="new-category-form"
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
                                        <button type="submit" id="category-submit" class="btn btn-primary me-1 mb-1">Salvar
                                        </button>
                                    </div>
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table table-lg" id="table-categorias">
                                                <thead>
                                                <tr>
                                                    <th scope="col">Categoria</th>
                                                    <th scope="col">Editar</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
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
                <div class="modal-header">
                    <h5 class="modal-title">Unidades</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="post" action="/almoxarifado/adicionar-unidade" id="unity-form"
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
                                        <button type="submit" id="unity-submit" class="btn btn-primary me-1 mb-1">Salvar
                                        </button>
                                    </div>
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table table-lg" id="table-unity">
                                                <thead>
                                                <tr>
                                                    <th scope="col">Unidade</th>
                                                    <th scope="col">Editar</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
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