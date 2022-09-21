<?php $v->layout("_theme"); ?>
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Novo Pedido / Orçamento</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="post" action="<?= url("salvar-pedido") ?>" id="form-request"
                                  enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-4 col-12 mt-2">
                                        <div class="form-group">
                                            <label for="request_number">Número do pedido do cliente</label>
                                            <input type="text" id="request_number" class="form-control"
                                                   name="request_number" placeholder="Nº Pedido">
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-12"></div>
                                    <div class="col-md-6 col-12 mt-2">
                                        <div class="form-group">
                                            <label for="client">Escolha um cliente
                                                <a href="<?= url("novo-cliente") ?>"><i class="fal fa-plus-circle"></i>
                                                </a>
                                            </label>
                                            <select name="client" id="client" class="form-select" required>
                                                <option></option>
                                                <?php
                                                if (!empty($clients)):
                                                    foreach ($clients as $client):
                                                        ?>
                                                    <option value="<?= $client->client_id ?>"><?= $client->client_name ?></option>
                                                <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12 mt-2">
                                        <div class="form-group">
                                            <label for="seller">Escolha o representante comercial</label>
                                            <select name="seller" id="seller" class="form-select" multiple>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12 mt-2">
                                        <div class="form-group">
                                            <label for="service-type">Tipo de serviço</label>
                                            <select name="service-type" id="service-type" class="form-select" required>
                                                <option>Escolha o tipo</option>
                                                <option value="Industrialização">Industrialização</option>
                                                <option value="Reforma">Reforma</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12 mt-2">
                                        <div class="form-group">
                                            <label for="situation">Situação do orçamento</label>
                                            <select name="situation" id="situation" class="form-select" required>
                                                <option>Escolha a situação</option>
                                                <option value="Aguardando Cliente">Aguardando Cliente</option>
                                                <option value="Aprovado">Aprovado</option>
                                                <option value="Reprovado">Reprovado</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12 mt-2">
                                        <div class="form-group">
                                            <label for="validity">Validade do orçamento</label>
                                            <input type="date" id="validity" class="form-control"
                                                   name="validity" placeholder="Usuário" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12 mt-2">
                                        <div class="form-group">
                                            <label for="draw">Arquivos / Desenho do projeto</label>
                                            <input type="file" class="form-control" name="draw[]" id="draw" multiple>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12 mt-2">
                                        <div class="form-group">
                                            <label for="draw-type">Tipo do desenho</label>
                                            <select name="draw-type" id="draw-type" class="form-select">
                                                <option>Escolha o tipo</option>
                                                <option value="Temporário">Temporário</option>
                                                <option value="Definitivo">Definitivo</option>
                                                <option value="Próprio">Próprio</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12 mt-2">
                                        <div class="form-group">
                                            <label for="email-history">Arquivar e-mails</label>
                                            <input type="file" class="form-control" name="email-history[]"
                                                   id="email-history" multiple>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12 mt-2">
                                        <div class="form-group">
                                            <label for="other-files">Arquivos adicionais</label>
                                            <input type="file" class="form-control" name="other-files[]" id="other-files"
                                            multiple>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12 mt-2">
                                        <div class="form-group">
                                            <label for="link-request">Vincular pedido</label>
                                            <input type="button" data-bs-toggle="modal" data-bs-target="#link-request-modal"
                                                   id="link-request" value="Escolher pedido" class="form-control">
                                            <input type="hidden" id="link-request-id" name="link-request-id">
                                        <small id="link-request-response"></small>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="form-group">
                                            <label for="general-observations">Observações gerais</label>
                                            <textarea rows="5" class="form-control" name="general-observations"
                                                      id="general-observations"></textarea>
                                        </div>
                                    </div>


                                    <h5 class="mb-4 mt-5">Itens do orçamento</h5>
                                    <div class="col-md-3 col-12 mt-2">
                                        <div class="form-group">
                                            <label for="item">Item</label>
                                            <input type="text" id="item" class="form-control"
                                                   name="item" placeholder="Item">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12 mt-2">
                                        <div class="form-group">
                                            <label for="amount">Qtde.</label>
                                            <input type="text" id="amount" class="form-control"
                                                   name="amount" placeholder="Qtde.">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12 mt-2">
                                        <div class="form-group">
                                            <label for="draw-number">N° Desenho</label>
                                            <input type="text" id="draw-number" class="form-control"
                                                   name="draw-number" placeholder="N° Desenho">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12 mt-2">
                                        <div class="form-group">
                                            <label for="description">Descrição</label>
                                            <input type="text" id="description" class="form-control"
                                                   name="description" placeholder="Descrição">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12 mt-2">
                                        <div class="form-group">
                                            <label for="currency">Tipo da moeda</label>
                                            <select name="currency" id="currency" class="form-select">
                                                <option>Escolha o tipo</option>
                                                <option value="Real">Real</option>
                                                <option value="Dólar">Dólar</option>
                                                <option value="Euro">Euro</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12 mt-2">
                                        <div class="form-group">
                                            <label for="unit-price">Preço Unit.</label>
                                            <input type="text" id="unit-price" class="form-control"
                                                   name="unit-price" placeholder="Preço Unit.">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12 mt-2">
                                        <div class="form-group">
                                            <label for="discount">Desconto em $
                                                <div class="form-check form-switch" style="display: inline-block">
                                                    <input class="form-check-input" type="checkbox" id="discount-switch">
                                                    <label class="form-check-label" for="discount-switch">%</label>
                                                </div></label>
                                            <input type="text" id="discount" class="form-control"
                                                   name="discount" placeholder="Desconto">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12 mt-2">
                                        <div class="form-group">
                                            <label for="final-item-price">Preço Total</label>
                                            <input type="text" id="final-item-price" class="form-control"
                                                   name="final-item-price" placeholder="Preço Total">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12 mt-2">
                                        <div class="form-group">
                                            <label for="date">Data de entrega</label>
                                            <input type="date" id="delivery-date" class="form-control"
                                                   name="date" placeholder="Data de entrega">
                                        </div>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <div class="form-group">
                                            <label for="item-observation">Observações do item</label>
                                            <textarea rows="2" class="form-control" name="item-observation"
                                            id="item-observation"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-3 mt-2">
                                        <div class="form-group">
                                            <label for="username">Notificação</label>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="item-notification"
                                                       id="item-notification">
                                                <label class="form-check-label" for="item-notification"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4 d-flex justify-content-end">
                                        <a type="button" id="item_add" class="btn btn-primary me-1 mb-1">Adicionar Item</a>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="table-responsive">
                                            <table class="table table-lg" id="table-itens">
                                                <thead>
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Qtde.</th>
                                                    <th>N° Desenho</th>
                                                    <th>Descrição</th>
                                                    <th>Tipo moeda</th>
                                                    <th>Preço Unit.</th>
                                                    <th>Desconto</th>
                                                    <th>Preço Total</th>
                                                    <th>Data entrega</th>
                                                    <th>Observação item</th>
                                                    <th>Notificação</th>
                                                    <th>Remover</th>
                                                </tr>
                                                </thead>
                                                <tbody id="body-table-itens">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12 mt-2">
                                        <div class="form-group">
                                            <label for="general-discount">Desconto geral em $
                                                <div class="form-check form-switch" style="display: inline-block">
                                                    <input class="form-check-input" type="checkbox" id="general-discount-switch">
                                                    <label class="form-check-label" for="general-discount-switch">%</label>
                                                </div></label>
                                            <input type="text" id="general-discount" class="form-control"
                                                   name="general-discount" placeholder="Desconto Geral">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12 mt-2">
                                        <div class="form-group">
                                            <label for="general-item-discount">Desconto dos itens</label>
                                            <input type="text" id="general-item-discount" class="form-control"
                                                   name="general-item-discount" placeholder="Desconto dos itens" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12 mt-2">
                                        <div class="form-group">
                                            <label for="final-price">Valor Total</label>
                                            <input type="text" id="final-price" class="form-control"
                                                   name="final-price" placeholder="Valor Total" readonly>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-4 d-flex justify-content-end">
                                        <button type="submit" id="save-button" class="btn btn-primary me-1 mb-1">Salvar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="link-request-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Vincular pedido</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="post" action="/buscar-vincular" id="link-request-form"
                                  enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="request_id">N° do pedido</label>
                                            <input type="text" id="request_id" class="form-control"
                                                   name="request_id" maxlength="250" required>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4 d-flex justify-content-end">
                                        <button type="submit" id="link-submit" class="btn btn-primary me-1 mb-1">Vincular
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
    <script src="<?= url_views("panel/_js/new_request.js"); ?>"></script>
<?php $v->end(); ?>