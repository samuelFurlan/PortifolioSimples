<?php $v->layout("_theme"); ?>
    <div class="page-heading">
        <h3>Fornecedores</h3>
    </div>
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Novo Fornecedor</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="post" action="/compras/salvar-fornecedor" id="new-provider-form"
                                  enctype="multipart/form-data">
                                <input type="hidden" name="provider_id" id="provider_id">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="category">Categoria
                                                <i class="fal fa-plus-circle" data-bs-toggle="modal" data-bs-target="#link-request-modal"></i>
                                            </label>
                                            <select class="form-select"  id="category" name="category" required>
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
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="cnpj">CNPJ</label>
                                            <input type="text" id="cnpj" class="form-control"
                                                   name="cnpj" placeholder="CNPJ" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="name">Razão / Nome Fantasia</label>
                                            <input type="text" id="name" class="form-control"
                                                   name="name" placeholder="Razão / Nome Fantasia" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" id="email" class="form-control"
                                                   name="email" placeholder="Email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="contact">Telefone</label>
                                            <input type="text" id="contact" class="form-control"
                                                   name="contact" placeholder="Telefone">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="cellphone">Celular</label>
                                            <input type="text" id="cellphone" class="form-control"
                                                   name="cellphone" placeholder="Celular">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="others">Outros</label>
                                            <input type="text" id="others" class="form-control"
                                                   name="others" placeholder="Outros">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="sellers">Vendedores
                                                <i class="fal fa-plus-circle" data-bs-toggle="modal" data-bs-target="#link-seller-modal"></i>
                                            </label>
                                            <select class="form-select"  id="sellers" name="sellers" required>
                                                <?php
                                                if (!empty($sellers)):
                                                    foreach ($sellers as $seller):
                                                        ?>
                                                        <option value="<?= $seller->seller_id ?>"><?= $seller->seller_name ?></option>
                                                    <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-4 d-flex justify-content-end">
                                        <button type="reset" onclick="$('#provider_id').val('');" id="button-reset-provider" class="btn btn-light-secondary me-1 mb-1">Limpar</button>
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
                        <h4 class="card-title">Todos Fornecedores</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="col-12 mb-4">
                                <div class="col-4">
                                    <label for="searchCategory">Buscar por categoria:</label>
                                    <select class="form-control" name="searchCategory" id="searchCategory">
                                        <option value="">Todas Categorias</option>
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
                            <div class="table-responsive">
                                <table class="table table-lg" id="table-providers">
                                    <thead>
                                    <tr>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Telefone</th>
                                        <th scope="col">Editar</th>
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
    <div class="modal fade" id="link-seller-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Vendedores</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="post" action="/compras/adicionar-vendedor-fornecedor" id="new-seller-form"
                                  enctype="multipart/form-data">
                                <input type="hidden" id="id_seller" name="id_seller">
                                <div class="row">
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label for="sellerName">Adicionar Vendedor</label>
                                            <input type="text" id="sellerName" class="form-control"
                                                   name="sellerName" maxlength="250" required>
                                        </div>
                                    </div>
                                    <div class="col-3 mt-4">
                                        <button type="submit" id="seller-submit" class="btn btn-primary me-1 mb-1">Salvar
                                        </button>
                                    </div>
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table table-lg" id="table-vendedor">
                                                <thead>
                                                <tr>
                                                    <th scope="col" style="width: 100%">Vendedor</th>
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
    <script src="<?= url_views("panel/_js/provider.js"); ?>"></script>
<?php $v->end(); ?>