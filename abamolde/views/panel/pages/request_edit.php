<?php $v->layout("_theme"); ?>
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Editar Pedido / Orçamento</h4>
                    </div>
                    <?php
                    if (empty($request)):
                        ?>
                        <div class="card-content">
                            <div class="card-body">
                                <h3>Pedido / Orçamento não encontrado!</h3>
                            </div>
                        </div>
                    <?php
                    else:
                        ?>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form" method="post" action="<?= url("salvar-pedido-editado") ?>"
                                      id="form-edit-request"
                                      enctype="multipart/form-data">
                                    <input type="hidden" name="id_request" id="id_request"
                                           value="<?= $request->request_id ?>">
                                    <div class="row">
                                        <div class="col-md-4 col-12 mt-2">
                                            <div class="form-group">
                                                <label for="request_number">Número do pedido do cliente</label>
                                                <input type="text" id="request_number" class="form-control"
                                                       name="request_number" placeholder="Nº Pedido"
                                                       value="<?= $request->request_number !== "" ? $request->request_number : $request->request_id ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-12"></div>
                                        <div class="col-md-6 col-12 mt-2">
                                            <div class="form-group">
                                                <label for="client">Escolha um cliente
                                                    <a href="<?= url("novo-cliente") ?>"><i
                                                                class="fal fa-plus-circle"></i>
                                                    </a>
                                                </label>
                                                <select name="client" id="client" class="form-select" required>
                                                    <option>Escolha um cliente</option>
                                                    <?php
                                                    if (!empty($clients)):
                                                        foreach ($clients as $client):
                                                            ?>
                                                            <option value="<?= $client->client_id ?>" <?= $request->request_fk_client == $client->client_id ? "selected" : "" ?>><?= $client->client_name ?></option>
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
                                                <select name="seller" id="seller"
                                                        class="choices form-select multiple-remove" multiple="multiple">
                                                    <?php
                                                    if (!empty($sellers)):
                                                        $sellers_list = explode(",", $request->request_fk_seller);
                                                        var_dump($sellers_list);
                                                        foreach ($sellers as $seller):
                                                            ?>
                                                            <option value="<?= $seller->seller_id ?>" <?= in_array($seller->seller_id, $sellers_list) ? "selected" : "" ?>><?= $seller->seller_name ?></option>
                                                        <?php
                                                        endforeach;
                                                    endif;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12 mt-2">
                                            <div class="form-group">
                                                <label for="service-type">Tipo de serviço</label>
                                                <select name="service-type" id="service-type" class="form-select"
                                                        required>
                                                    <option>Escolha o tipo</option>
                                                    <option value="Industrialização" <?= $request->request_service_type == "Industrialização" ? "selected" : "" ?>>
                                                        Industrialização
                                                    </option>
                                                    <option value="Reforma" <?= $request->request_service_type == "Reforma" ? "selected" : "" ?>>
                                                        Reforma
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12 mt-2">
                                            <div class="form-group">
                                                <label for="situation">Situação do orçamento</label>
                                                <select name="situation" id="situation" class="form-select" required>
                                                    <option>Escolha a situação</option>
                                                    <option value="Aguardando Cliente" <?= $request->request_situation == "Aguardando Cliente" ? "selected" : "" ?>>
                                                        Aguardando Cliente
                                                    </option>
                                                    <option value="Aprovado" <?= $request->request_situation == "Aprovado" ? "selected" : "" ?>>
                                                        Aprovado
                                                    </option>
                                                    <option value="Reprovado" <?= $request->request_situation == "Reprovado" ? "selected" : "" ?>>
                                                        Reprovado
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12 mt-2">
                                            <div class="form-group">
                                                <label for="validity">Validade do orçamento</label>
                                                <input type="date" id="validity" class="form-control"
                                                       name="validity" placeholder="Usuário"
                                                       value="<?= $request->request_validity ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 mt-2">
                                            <div class="form-group">
                                                <label for="draw">Arquivos / Desenho do projeto</label>
                                                <i class="fal fa-history" data-bs-toggle="modal"
                                                   data-bs-target="#draws-modal" style="cursor: pointer;"></i>
                                                <input type="file" class="form-control" name="draw" id="draw" multiple>
                                            </div>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="draws-modal" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Arquivos Enviandos</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-content">
                                                            <div class="card-body">
                                                                <ul>
                                                                    <?php
                                                                    if (!empty($request->request_draw)):
                                                                        foreach (json_decode($request->request_draw) as $item):
                                                                            $explode = explode("/", $item->file);
                                                                            ?>
                                                                            <li><a target="_blank"
                                                                                   href="<?= url($item->file) ?>"><?= end($explode) . " - " . $item->draw_type ?></a>
                                                                            </li>
                                                                        <?php
                                                                        endforeach;
                                                                    else:
                                                                        ?>
                                                                        <li>Nenhum arquivo enviado</li>
                                                                    <?php
                                                                    endif;

                                                                    ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 mt-2">
                                            <div class="form-group">
                                                <label for="draw-type">Tipo do desenho</label>
                                                <select name="draw-type" id="draw-type" class="form-select" required>
                                                    <option>Escolha o tipo</option>
                                                    <option value="Temporário" <?= $request->request_draw_type == "Temporário" ? "selected" : "" ?>>
                                                        Temporário
                                                    </option>
                                                    <option value="Definitivo" <?= $request->request_draw_type == "Definitivo" ? "selected" : "" ?>>
                                                        Definitivo
                                                    </option>
                                                    <option value="Próprio" <?= $request->request_draw_type == "Próprio" ? "selected" : "" ?>>
                                                        Próprio
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12 mt-2">
                                            <div class="form-group">
                                                <label for="email-history">Arquivar e-mails</label>
                                                <i class="fal fa-history" data-bs-toggle="modal"
                                                   data-bs-target="#emails-modal" style="cursor: pointer;"></i>
                                                <input type="file" class="form-control" name="email-history"
                                                       id="email-history" multiple>
                                            </div>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="emails-modal" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Emails Arquivados</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-content">
                                                            <div class="card-body">
                                                                <ul>
                                                                    <?php
                                                                    if (!empty($request->request_email_history)):
                                                                        foreach (json_decode($request->request_email_history) as $item):
                                                                            $explode = explode("/", $item->file);
                                                                            ?>
                                                                            <li><a target="_blank"
                                                                                   href="<?= url($item->file) ?>"><?= end($explode) . " - " . $item->draw_type ?></a>
                                                                            </li>
                                                                        <?php
                                                                        endforeach;
                                                                    else:
                                                                        ?>
                                                                        <li>Nenhum arquivo enviado</li>
                                                                    <?php
                                                                    endif;
                                                                    ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12 mt-2">
                                            <div class="form-group">
                                                <label for="other-files">Arquivos adicionais</label>
                                                <i class="fal fa-history" data-bs-toggle="modal"
                                                   data-bs-target="#others-modal" style="cursor: pointer;"></i>
                                                <input type="file" class="form-control" name="other-files"
                                                       id="other-files" multiple>
                                            </div>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="others-modal" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Arquivos Adicionais</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-content">
                                                            <div class="card-body">
                                                                <ul>
                                                                    <?php
                                                                    if (!empty($request->request_other_files)):
                                                                    foreach (json_decode($request->request_other_files) as $item):
                                                                        $explode = explode("/", $item->file);
                                                                        ?>
                                                                        <li><a target="_blank"
                                                                               href="<?= url($item->file) ?>"><?= end($explode) . " - " . $item->draw_type ?></a>
                                                                        </li>
                                                                    <?php
                                                                    endforeach;
                                                                    else:
                                                                        ?>
                                                                        <li>Nenhum arquivo enviado</li>
                                                                    <?php
                                                                    endif;
                                                                    ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12 mt-2">
                                            <div class="form-group">
                                                <label for="link-request">Vincular pedido</label>
                                                <input type="button" data-bs-toggle="modal"
                                                       data-bs-target="#link-request-modal"
                                                       id="link-request" value="Escolher pedido" class="form-control">
                                                <input type="hidden" id="link-request-id" name="link-request-id"
                                                       value="<?= $request->request_link !== 0 ? $request->request_link : "" ?>">
                                                <small id="link-request-response"><?= $request->request_link !== 0 ? "Vinculado ao pedido N° " . $request->request_link . " <i class='fal fa-times-circle' onclick='removeLink()'></i>" : "" ?></small>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <div class="form-group">
                                                <label for="general-observations">Observações gerais</label>
                                                <textarea rows="5" class="form-control" name="general-observations"
                                                          id="general-observations"><?= $request->request_general_observations ?></textarea>
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
                                                        <input class="form-check-input" type="checkbox"
                                                               id="discount-switch">
                                                        <label class="form-check-label" for="discount-switch">%</label>
                                                    </div>
                                                </label>
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
                                                    <input class="form-check-input" type="checkbox"
                                                           name="item-notification"
                                                           id="item-notification">
                                                    <label class="form-check-label" for="item-notification"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-4 d-flex justify-content-end">
                                            <a type="button" id="item_add" class="btn btn-primary me-1 mb-1">Adicionar
                                                Item</a>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <div class="table-responsive">
                                                <table class="table table-lg" id="table-itens">
                                                    <thead>
                                                    <tr>
                                                        <th style="display: none">Id</th>
                                                        <th style="width: 90px;">Item</th>
                                                        <th style="width: 90px;">Qtde.</th>
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
                                                    <?php
                                                    foreach ($itens as $iten):
                                                        ?>
                                                        <tr>
                                                            <td style="display: none"><?= $iten->item_id ?></td>
                                                            <td><?= $iten->item_number ?></td>
                                                            <td><?= $iten->item_amount ?></td>
                                                            <td><?= $iten->item_draw_number ?></td>
                                                            <td><?= $iten->item_description ?></td>
                                                            <td><?= $iten->item_currency ?></td>
                                                            <td><?= $iten->item_unit_price ?></td>
                                                            <td><?= $iten->item_discount ?></td>
                                                            <td><?= $iten->item_final_price ?></td>
                                                            <td><?= $iten->item_delivery_date ?></td>
                                                            <td><?= $iten->item_observation ?></td>
                                                            <td><?= $iten->item_notification ?></td>
                                                            <td><i class='fal fa-times'
                                                                   onclick='$(this).closest("tr").remove();removeItem(<?= $iten->item_id ?>)'></i>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    endforeach;
                                                    ?>

                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12 mt-2">
                                            <div class="form-group">
                                                <label for="general-discount">Desconto geral em $
                                                    <div class="form-check form-switch" style="display: inline-block">
                                                        <input class="form-check-input" type="checkbox"
                                                               id="general-discount-switch" <?= strpos($request->request_general_discount, "%") ? "checked" : "" ?>>
                                                        <label class="form-check-label"
                                                               for="general-discount-switch">%</label>
                                                    </div>
                                                </label>
                                                <input type="text" id="general-discount" class="form-control"
                                                       name="general-discount" placeholder="Desconto Geral"
                                                       value="<?= $request->request_general_discount ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12 mt-2">
                                            <div class="form-group">
                                                <label for="general-item-discount">Desconto dos itens</label>
                                                <input type="text" id="general-item-discount" class="form-control"
                                                       name="general-item-discount" placeholder="Desconto dos itens"
                                                       value="<?= $request->request_general_item_discount ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12 mt-2">
                                            <div class="form-group">
                                                <label for="final-price">Valor Total</label>
                                                <input type="text" id="final-price" class="form-control"
                                                       name="final-price" placeholder="Valor Total"
                                                       value="<?= $request->request_final_price ?>" readonly>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-4 d-flex justify-content-end">
                                            <button type="button" id="btn_production" class="btn btn-success me-1 mb-1">
                                                Enviar para produção
                                            </button>
                                            <button type="button" id="btn_disable"
                                                    class="btn btn-danger me-1 mb-1" <?= $request->request_situation == "0" ? "style='display: none'" : "" ?>>
                                                Desativar
                                            </button>
                                            <button type="button" id="btn_enable"
                                                    class="btn btn-success me-1 mb-1" <?= $request->request_situation == "0" ? "" : "style='display: none'" ?> >
                                                Ativar
                                            </button>
                                            <div class="dropdown">
                                                <button class="btn btn-primary me-1 mb-1 dropdown-toggle" type="button"
                                                        id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                    Gerar PDF
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <li><a href="<?= url("imprimir-pedido/" . $request->request_id) ?>"
                                                           target="_blank" class="dropdown-item">Imprimir</a></li>
                                                    <li><a style="cursor:pointer;" class="dropdown-item"
                                                           data-bs-toggle="modal" data-bs-target="#send-email-modal">Enviar
                                                            por e-mail</a></li>
                                                </ul>
                                            </div>
                                            <button type="submit" id="btn_update" class="btn btn-primary me-1 mb-1">
                                                Atualizar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php
                    endif;
                    ?>
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
                                        <button type="submit" id="link-submit" class="btn btn-primary me-1 mb-1">
                                            Vincular
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

    <!-- Modal -->
    <div class="modal fade" id="send-email-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Enviar PDF</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="post" action="/send-mail" id="send-mail-form"
                                  enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="request_id">Enviar para:</label>
                                            <input type="email" id="for_email" class="form-control"
                                                   name="for_email" maxlength="250" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="request_id">Copia para: (separar com espaço)</label>
                                            <input type="text" id="copy_email" class="form-control"
                                                   name="copy_email">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="request_id">Mensagem:</label>
                                            <textarea class="form-control" id="mensagen_email" name="mensagem_email"
                                                      rows="4"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4 d-flex justify-content-end">
                                        <button type="submit" id="link-submit" class="btn btn-primary me-1 mb-1">
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
    <script src="<?= url_views("panel/_js/new_request.js"); ?>"></script>
<?php $v->end(); ?><?php
