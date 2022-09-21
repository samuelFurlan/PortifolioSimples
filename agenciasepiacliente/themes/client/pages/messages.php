<?php $v->layout("_theme_client"); ?>
    <section class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Usuários Cadastrados</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <!-- Table with outer spacing -->
                                <div class="table-responsive">
                                    <table class="table table-lg" id="tableMessages">
                                        <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Email</th>
                                            <th>Contato</th>
                                            <th>Mensagem</th>
                                            <th>Data Envio</th>
                                            <th>Origem Envio</th>
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
        </div>
    </section>
<?php $v->start("scripts"); ?>
    <script src="<?= url("themes/client/assets/js/messages.js"); ?>"></script>
<?php $v->end(); ?>