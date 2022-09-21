<?php $v->layout("_theme"); ?>
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Nova entrada manual</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="post" action="/ferramentaria/adicionar-produto-ferramentaria"
                                  id="entry-tooling-form"
                                  enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="tipo">Item</label>
                                            <select class="form-select"  id="item" name="item" required>
                                                <option value=""></option>
                                                <?php
                                                if (!empty($tooling)):
                                                    foreach ($tooling as $item):
                                                        ?>
                                                        <option value="<?= $item->tooling_id ?>"><?=  $item->tooling_serial. " - " . $item->productName()->productName ?></option>
                                                    <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="condition">Estado atual (%)</label>
                                            <input type="number" id="condition" class="form-control"
                                                   name="condition" min="0" max="100" step="1" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="nf">Requisição</label>
                                            <input type="text" id="nf" class="form-control"
                                                   name="nf" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="date">Data devolulção</label>
                                            <input type="date" id="date" class="form-control"
                                                   name="date" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="nf">Colaborador</label>
                                            <input type="text" id="employee" class="form-control"
                                                   name="employee" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="nf">Observação</label>
                                            <textarea name="observation" id="observation" class="form-control" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4 d-flex justify-content-end">
                                        <button type="reset"  id="btn-reset" class="btn btn-light-secondary me-1 mb-1">Limpar</button>
                                        <button type="submit" id="button-submit" class="btn btn-primary me-1 mb-1">
                                            Adicionar
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
    <script src="<?= url_views("panel/_js/tooling_entry.js"); ?>"></script>
<?php $v->end(); ?>