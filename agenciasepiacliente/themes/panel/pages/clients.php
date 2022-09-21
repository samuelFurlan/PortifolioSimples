<?php $v->layout("_theme_panel"); ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Clientes</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= url("painel"); ?>">Início</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Clientes</li>
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
                        <h4 class="card-title">Cadastrar novo cliente</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" method="post" id="client-forms"
                                  action="<?= url("painel/salvar-cliente") ?>"
                                  enctype="multipart/form-data">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="clientName">Nome do Cliente / Empresa</label>
                                                <input type="text" id="clientName"
                                                       class="form-control" name="clientName"
                                                       placeholder="Nome do Cliente / Empresa" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="archive">Imagem / Logo do Cliente</label>
                                                <input type="file" id="archive"
                                                       class="form-control" name="archive"
                                                       placeholder="Nome do Cliente / Empresa"
                                                       accept="image/*" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="userClient">Nome de usuário (Login)</label>
                                                <input type="text" id="userClient"
                                                       class="form-control" name="userClient"
                                                       placeholder="Nome de usuário" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="password">Senha de usuário</label>
                                                <input type="password" id="password"
                                                       class="form-control" name="password"
                                                       placeholder="Senha de usuário" required>
                                            </div>
                                        </div>
                                        <div class="col-6 mt-2">
                                            <div class="card border">
                                                <div class="card-body py-4 px-5">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-xl">
                                                            <img id="previewImage"
                                                                 src="<?= url("themes/_assets/_images/defaults/default-avatar.jpg"); ?>"
                                                                 alt="Logo Cliente">
                                                        </div>
                                                        <div class="ms-3 name">
                                                            <h5 class="font-bold" id="clientNameLabel">Cliente</h5>
                                                            <h6 class="text-muted mb-0" id="clientUserLabel">
                                                                Usuário</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6" id="divInfo" style="display: none">
                                            <div class="card">
                                                <div class="card-body py-4 px-5">
                                                    <div class="alert alert-info">
                                                        <p>Para manter Imagem / Logo ou Senha de usuário basta deixar em branco.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="reset" onclick="cleanForms()" id="btnReset"
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
                        <h4 class="card-title">Clientes Cadastrados</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <!-- Table with outer spacing -->
                            <div class="table-responsive">
                                <table class="table table-lg" id="tableClients">
                                    <thead>
                                    <tr>
                                        <th>Imagem</th>
                                        <th>Nome</th>
                                        <th>Usuário</th>
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
<script src="<?= url("themes/panel/assets/js/clients.js"); ?>"></script>
<?php $v->end(); ?>
