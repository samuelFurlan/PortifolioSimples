<?php $v->layout("_theme"); ?>
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Nova retirada manual</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="post" action="/almoxarifado/remover-produto-almoxarifado"
                                  id="remove-warehouse-form"
                                  enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="category">Categoria</label>
                                            <select class="form-select"  id="category" name="category" required>
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
                                    <div class="col-12"></div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="tipo">Item</label>
                                            <select class="form-select"  id="item" name="item" required>
                                                <option value="">Escolha uma categoria</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="amount">Quantidade</label>
                                            <input type="number" id="amount" class="form-control"
                                                   name="amount" min="1" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="nf">Requisição (Opcional)</label>
                                            <input type="text" id="request" class="form-control"
                                                   name="request">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12 mt-2">
                                        <div class="form-group">
                                            <label for="nf">Colaborador (Opcional)</label>
                                            <input type="text" id="employee" class="form-control"
                                                   name="employee">
                                        </div>
                                    </div>
                                    <div class="col-md-4  col-12 mt-2">
                                        <div class="form-group">
                                            <label for="date">Data de retirada</label>
                                            <input type="date" id="date" class="form-control"
                                                   name="date" value="<?php echo date("Y-m-d"); ?>">
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4 d-flex justify-content-end">
                                        <button type="reset"  id="btn-reset" class="btn btn-light-secondary me-1 mb-1">Limpar</button>
                                        <button type="submit" id="button-submit" class="btn btn-primary me-1 mb-1">
                                            Retirada
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
<?php $v->start("scripts"); ?>
    <script src="<?= url_views("panel/_js/warehouse_remove.js"); ?>"></script>
<?php $v->end(); ?>