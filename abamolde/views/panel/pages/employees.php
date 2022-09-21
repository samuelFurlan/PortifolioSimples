<?php $v->layout("_theme"); ?>
<div class="page-heading">
    <h3>Usuários</h3>
</div>
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Novo usuário</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="post" action="/salvar-colaborador" id="new-employe-form"
                              enctype="multipart/form-data">
                            <input type="hidden" name="employe_id" id="employe_id">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="name">Nome</label>
                                        <input type="text" id="name" class="form-control"
                                               name="name" placeholder="Nome" required>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="roles">Cargo
                                            <a href="<?= url("cargos")?>">
                                                <i class="fal fa-plus-circle"></i>
                                            </a></label>
                                        <select name="roles" id="roles" class="form-select" required>
                                            <option value="">Escolha um cargo</option>
                                            <?php
                                            if (!empty($roles)):
                                                foreach ($roles as $role):
                                                    ?>
                                                    <option value="<?= $role->role_id ?>"><?= $role->role_name ?></option>
                                            <?php
                                                endforeach;
                                            endif;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="username">Usuário (Login)</label>
                                        <input type="text" id="username" class="form-control"
                                               name="username" placeholder="Usuário" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="password">Senha</label>
                                        <input type="password" id="password" class="form-control"
                                               name="password" placeholder="Senha">
                                    </div>
                                    <div class="col-12" id="password-alert" style="display: none;">
                                        <small class="bg-light-info"><i class="fal fa-exclamation-circle"></i> Caso não deseje alterar a senha, basta deixar o campo em branco!</small>
                                    </div>
                                </div>
                                <div class="col-12 mt-4 d-flex justify-content-end">
                                    <button type="reset" onclick="$('#employe_id').val('');" id="button-reset" class="btn btn-light-secondary me-1 mb-1">Limpar</button>
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
                        <h4 class="card-title">Todos usuários</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-lg" id="table-employees">
                                    <thead>
                                    <tr>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Cargo</th>
                                        <th scope="col">Usuário (Login)</th>
                                        <th scope="col">Criado</th>
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
    <script src="<?= url_views("panel/_js/employees.js"); ?>"></script>
<?php $v->end(); ?>