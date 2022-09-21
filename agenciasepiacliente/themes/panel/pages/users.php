<?php $v->layout("_theme_panel"); ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Usuários</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= url("painel"); ?>">Início</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Usuários</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Basic Vertical form layout section start -->
    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Cadastrar novo Usuário</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" method="post" id="user-forms"
                                  action="<?= url("painel/salvar-usuario") ?>"
                                  enctype="multipart/form-data">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="userAccess">Nome de usuário (Login)</label>
                                                <input type="text" id="userAccess"
                                                       class="form-control" name="userAccess"
                                                       placeholder="Nome de usuário" required>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="password">Senha de usuário</label>
                                                <input type="password" id="password"
                                                       class="form-control" name="password"
                                                       placeholder="Senha de usuário" required>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="typeAccess">Tipo de usuário</label>
                                                <select class="form-select" name="typeAccess" id="typeAccess" required>
                                                    <option value="1">Administrador</option>
                                                    <option value="2">Colaborador</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12" id="divInfo" style="display: none">
                                            <div class="card">
                                                <div class="card-body py-4 px-5">
                                                    <div class="alert alert-info text-center">
                                                        <p>Para não alterar Senha de usuário basta deixar em branco.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="reset" id="btnReset" onclick="cleanForms()"
                                                    class="btn btn-light-secondary me-1 mb-1">Limpar
                                            </button>
                                            <button type="submit" id="btnSubmit" class="btn btn-primary me-1 mb-1">
                                                Salvar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Usuários Cadastrados</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <!-- Table with outer spacing -->
                            <div class="table-responsive">
                                <table class="table table-lg" id="tableUsers">
                                    <thead>
                                    <tr>
                                        <th>Usuário</th>
                                        <th>Perfil</th>
                                        <th>Status</th>
                                        <th>Editar</th>
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
</div>
<?php $v->start("scripts"); ?>
<script src="<?= url("themes/panel/assets/js/users.js"); ?>"></script>
<?php $v->end(); ?>
