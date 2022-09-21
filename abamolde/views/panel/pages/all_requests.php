<?php $v->layout("_theme"); ?>
    <div class="page-heading">
        <h3>Pedidos / Orçamentos </h3>
    </div>
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Todos</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-lg" id="table-request">
                                    <thead>
                                    <tr>
                                        <th scope="col">N° Pedido</th>
                                        <th scope="col">Data de criação</th>
                                        <th scope="col">Primeira entrega</th>
                                        <th scope="col">Última entrega</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Desenho</th>
                                        <th scope="col">Visualizar</th>
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
    <script src="<?= url_views("panel/_js/request_all.js"); ?>"></script>
<?php $v->end(); ?>