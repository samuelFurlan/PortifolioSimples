<?php $v->layout("_theme"); ?>
    <div class="page-heading">
        <h3>Cargos</h3>
    </div>
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Novo Cargo</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="post" action="/salvar-cargo" id="new-role-form"
                                  enctype="multipart/form-data">
                                <input type="hidden" name="role_id" id="role_id">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="roleName">Nome do cargo</label>
                                            <input type="text" id="roleName" class="form-control"
                                                   name="roleName" placeholder="Nome do cargo" required>
                                        </div>
                                    </div>
                                    <div class="col-6"></div>
                                    <div class="col-12 mt-3">
                                        <p>Permissões de acesso</p>
                                    </div>
                                    <div class="form-group col-6">
                                        <div class='form-check'>
                                            <div class="checkbox">
                                                <input type="checkbox" id="request" name="request" class='form-check-input'>
                                                <label for="request">Pedido / Orçamentos</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <div class='form-check'>
                                            <div class="checkbox">
                                                <input type="checkbox" id="purchases" name="purchases" class='form-check-input'>
                                                <label for="purchases">Compras</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <div class='form-check'>
                                            <div class="checkbox">
                                                <input type="checkbox" id="warehouse" name="warehouse" class='form-check-input'>
                                                <label for="warehouse">Almoxarifado</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <div class='form-check'>
                                            <div class="checkbox">
                                                <input type="checkbox" id="tooling" name="tooling" class='form-check-input'>
                                                <label for="tooling">Ferramentaria</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <div class='form-check'>
                                            <div class="checkbox">
                                                <input type="checkbox" id="production" name="production" class='form-check-input'>
                                                <label for="production">Produção</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <div class='form-check'>
                                            <div class="checkbox">
                                                <input type="checkbox" id="configs" name="configs" class='form-check-input'>
                                                <label for="configs">Configurações</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4 d-flex justify-content-end">
                                        <button type="reset" onclick="$('#role_id').val('');" id="button-reset" class="btn btn-light-secondary me-1 mb-1">Limpar</button>
                                        <button type="submit" id="button-submit" class="btn btn-primary me-1 mb-1">Salvar</button>
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
                        <h4 class="card-title">Todos Cargos</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-lg" id="table-roles">
                                    <thead>
                                    <tr>
                                        <th scope="col">Cargo</th>
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
<?php $v->start("scripts"); ?>
    <script src="<?= url_views("panel/_js/roles.js"); ?>"></script>
<?php $v->end(); ?>