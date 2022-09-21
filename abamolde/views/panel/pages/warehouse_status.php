<?php $v->layout("_theme"); ?>
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Estoque Atual</h4>
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
                                <table class="table table-lg" id="table-warehouse">
                                    <thead>
                                    <tr>

                                        <th scope="col">Código</th>
                                        <th scope="col">Item</th>
                                        <th scope="col">Modelo</th>
                                        <th scope="col">Categoria</th>
                                        <th scope="col">Qtde. Atual</th>
                                        <th scope="col">Min.</th>
                                        <th scope="col">Estoque</th>
                                        <th scope="col">Alocação</th>
                                        <th scope="col">Ativo</th>
                                        <th scope="col">Ferramentaria</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if (!empty($products)):
                                        foreach ($products as $product):
                                            if ($product->product_current < $product->product_min):
                                                $row_color = "<i class='fa fa-circle' style='color: red;' ></i>";
                                            else:
                                                $row_color = "";
                                            endif;

                                            if ($product->product_status == 1) :
                                                $status = "<i class='fa fa-circle' style='color: green;'></i>";
                                            else:
                                                $status = "<i class='fa fa-circle' style='color: red;' ></i>";
                                            endif;

                                            if ($product->product_tooling == 1) :
                                                $tooling = "<i class='fa fa-plus-circle' style='cursor: pointer' onclick='sendTooling(".$product->product_id.")'></i>";
                                            else:
                                                $tooling = "";
                                            endif;
                                            ?>
                                        <tr>
                                            <td><?= $product->product_code ?></td>
                                            <td><?= $product->product_name ?></td>
                                            <td><?= $product->product_model ?></td>
                                            <td><?= $product->categoryName()->categoryName ?></td>
                                            <td><?= $product->product_current ?></td>
                                            <td><?= $product->product_min ?></td>
                                            <td><?= $row_color ?></td>
                                            <td><?= $product->product_alocation ?></td>
                                            <td><?= $status ?></td>
                                            <td style='text-align: center'><?= $tooling ?></td>
                                        </tr>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>
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
    <div class="modal fade" id="link-tooling-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Adicionar a ferramentaria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="post" action="/ferramentaria/enviar-ferramentaria" id="new-tooling-form"
                                  enctype="multipart/form-data">
                                <input type="hidden" id="id_product" name="id_product">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="codeProduct">Código</label>
                                            <input type="text" id="codeProduct" class="form-control"
                                                   name="codeProduct" readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="nameProduct">Item</label>
                                            <input type="text" id="nameProduct" class="form-control"
                                                   name="nameProduct" readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="makerProduct">Fabricante</label>
                                            <input type="text" id="makerProduct" class="form-control"
                                                   name="makerProduct" readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="modelProduct">Modelo</label>
                                            <input type="text" id="modelProduct" class="form-control"
                                                   name="modelProduct" readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="currentProduct">Estoque Atual</label>
                                            <input type="text" id="currentProduct" class="form-control"
                                                   name="currentProduct" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="qtdeSent">Escolha quantos enviar</label>
                                            <input type="number" id="qtdeSent" class="form-control"
                                                   name="qtdeSent" required>
                                        </div>
                                    </div>
                                    <div class="col-12" id="groupSerie">
                                    </div>
                                    <div class="col-12 mt-4 d-flex justify-content-end">
                                        <button type="submit" id="button-submit" class="btn btn-primary me-1 mb-1">
                                            Enviar
                                        </button>
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
    <script src="<?= url_views("panel/_js/warehouse_status.js"); ?>"></script>
<?php $v->end(); ?>