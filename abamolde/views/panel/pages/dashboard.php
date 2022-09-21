<?php $v->layout("_theme"); ?>
<div class="page-heading">
    <h3>Início</h3>
</div>
<section class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Em produção</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <!-- Table with outer spacing -->
                            <div class="table-responsive">
                                <table class="table" id="tableHome">
                                    <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Tipo</th>
                                        <th>Arquivo</th>
                                        <th>Cliente</th>
                                        <th>Status</th>
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
<script src="<?= url_views("panel/_js/dashboard.js"); ?>"></script>
<?php $v->end(); ?>
