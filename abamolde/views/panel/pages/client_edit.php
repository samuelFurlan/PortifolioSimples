<?php $v->layout("_theme"); ?>
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Editar Cliente</h4>
                    </div>
                    <?php
                    if (empty($client)):
                        ?>
                        <div class="card-content">
                            <div class="card-body">
                                <h3>Cliente não encontrado!</h3>
                            </div>
                        </div>
                    <?php
                    else:
                        $contacts = json_decode($client->client_contact);
                        ?>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form" method="post" action="/salvar-cliente" id="edit-client-form"
                                      enctype="multipart/form-data">
                                    <input type="hidden" name="client_id" id="client_id"
                                           value="<?= $client->client_id ?>">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="name">Nome / Empresa</label>
                                                <input type="text" id="name" class="form-control"
                                                       name="name" placeholder="Nome / Empresa" maxlength="250"
                                                       required value="<?= $client->client_name ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="document">CPF / CNPJ</label>
                                                <input type="text" id="document" class="form-control"
                                                       name="document" placeholder="CPF / CNPJ" required
                                                       value="<?= $client->client_document ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" id="email" class="form-control"
                                                       name="email" placeholder="Email" required
                                                       value="<?= $client->client_mail ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="contact">Telefone</label>
                                                <input type="text" id="contact" class="form-control"
                                                       name="contact" placeholder="Telefone"
                                                       value="<?= $contacts->contact ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="cellphone">Celular</label>
                                                <input type="text" id="cellphone" class="form-control"
                                                       name="cellphone" placeholder="Celular"
                                                       value="<?= $contacts->cellphone ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="others">Outros</label>
                                                <input type="text" id="others" class="form-control"
                                                       name="others" placeholder="Outros"
                                                       value="<?= $contacts->others ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-12">
                                            <div class="form-group">
                                                <label for="cep">CEP</label>
                                                <input type="text" id="cep" class="form-control"
                                                       name="cep" placeholder="CEP" required
                                                       value="<?= $client->client_cep ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="address">Endereço</label>
                                                <input type="text" id="address" class="form-control"
                                                       name="address" placeholder="Endereço" required
                                                       value="<?= $client->client_address ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-12">
                                            <div class="form-group">
                                                <label for="number">Número</label>
                                                <input type="text" id="number" class="form-control"
                                                       name="number" placeholder="Número"
                                                       value="<?= $client->client_address_number ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="complement">Complemento</label>
                                                <input type="text" id="complement" class="form-control"
                                                       name="complement" placeholder="Complemento"
                                                       value="<?= $client->client_address_complement ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="district">Bairro</label>
                                                <input type="text" id="district" class="form-control"
                                                       name="district" placeholder="Bairro"
                                                       value="<?= $client->client_district ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="city">Cidade</label>
                                                <input type="text" id="city" class="form-control"
                                                       name="city" placeholder="Cidade" required
                                                       value="<?= $client->client_city ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="state">Estado</label>
                                                <select class="form-select" name="state" id="state" required>
                                                    <option value="AC" <?= $client->client_state === "AC" ? "selected" : "" ?>>
                                                        Acre
                                                    </option>
                                                    <option value="AL" <?= $client->client_state === "AL" ? "selected" : "" ?>>
                                                        Alagoas
                                                    </option>
                                                    <option value="AP" <?= $client->client_state === "AP" ? "selected" : "" ?>>
                                                        Amapá
                                                    </option>
                                                    <option value="AM" <?= $client->client_state === "AM" ? "selected" : "" ?>>
                                                        Amazonas
                                                    </option>
                                                    <option value="BA" <?= $client->client_state === "BA" ? "selected" : "" ?>>
                                                        Bahia
                                                    </option>
                                                    <option value="CE" <?= $client->client_state === "CE" ? "selected" : "" ?>>
                                                        Ceará
                                                    </option>
                                                    <option value="DF" <?= $client->client_state === "DE" ? "selected" : "" ?>>
                                                        Distrito Federal
                                                    </option>
                                                    <option value="ES" <?= $client->client_state === "ES" ? "selected" : "" ?>>
                                                        Espírito Santo
                                                    </option>
                                                    <option value="GO" <?= $client->client_state === "GO" ? "selected" : "" ?>>
                                                        Goiás
                                                    </option>
                                                    <option value="MA" <?= $client->client_state === "MA" ? "selected" : "" ?>>
                                                        Maranhão
                                                    </option>
                                                    <option value="MT" <?= $client->client_state === "MT" ? "selected" : "" ?>>
                                                        Mato Grosso
                                                    </option>
                                                    <option value="MS" <?= $client->client_state === "MS" ? "selected" : "" ?>>
                                                        Mato Grosso do Sul
                                                    </option>
                                                    <option value="MG" <?= $client->client_state === "MG" ? "selected" : "" ?>>
                                                        Minas Gerais
                                                    </option>
                                                    <option value="PA" <?= $client->client_state === "PA" ? "selected" : "" ?>>
                                                        Pará
                                                    </option>
                                                    <option value="PB" <?= $client->client_state === "PB" ? "selected" : "" ?>>
                                                        Paraíba
                                                    </option>
                                                    <option value="PR" <?= $client->client_state === "PR" ? "selected" : "" ?>>
                                                        Paraná
                                                    </option>
                                                    <option value="PE" <?= $client->client_state === "PE" ? "selected" : "" ?>>
                                                        Pernambuco
                                                    </option>
                                                    <option value="PI" <?= $client->client_state === "PI" ? "selected" : "" ?>>
                                                        Piauí
                                                    </option>
                                                    <option value="RJ" <?= $client->client_state === "RJ" ? "selected" : "" ?>>
                                                        Rio de Janeiro
                                                    </option>
                                                    <option value="RN" <?= $client->client_state === "RN" ? "selected" : "" ?>>
                                                        Rio Grande do Norte
                                                    </option>
                                                    <option value="RS" <?= $client->client_state === "RS" ? "selected" : "" ?>>
                                                        Rio Grande do Sul
                                                    </option>
                                                    <option value="RO" <?= $client->client_state === "RO" ? "selected" : "" ?>>
                                                        Rondônia
                                                    </option>
                                                    <option value="RR" <?= $client->client_state === "RR" ? "selected" : "" ?>>
                                                        Roraima
                                                    </option>
                                                    <option value="SC" <?= $client->client_state === "SC" ? "selected" : "" ?>>
                                                        Santa Catarina
                                                    </option>
                                                    <option value="SP" <?= $client->client_state === "SP" ? "selected" : "" ?>>
                                                        São Paulo
                                                    </option>
                                                    <option value="SE" <?= $client->client_state === "SE" ? "selected" : "" ?>>
                                                        Sergipe
                                                    </option>
                                                    <option value="TO" <?= $client->client_state === "TO" ? "selected" : "" ?>>
                                                        Tocantins
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-4 d-flex justify-content-end">
                                            <button type="submit" id="button-submit" class="btn btn-primary me-1 mb-1">
                                                Atualizar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-header">
                            <h6 class="card-title">Comercial
                                <i class="fal fa-plus-circle" onclick="reset_seller()"
                                   data-bs-toggle="modal" data-bs-target="#seller-modal"
                                   style="cursor: pointer;"></i></h6>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <table class="table" id="table-seller">
                                    <thead>
                                    <tr>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Cargo / Função</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Celular</th>
                                        <th scope="col">Telefone</th>
                                        <th scope="col">Outros</th>
                                        <th scope="col">Ativo</th>
                                        <th scope="col">Editar</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
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
    <div class="modal fade" id="seller-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Novo Comercial</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form" method="post" action="/salvar-comercial" id="new-seller-form"
                          enctype="multipart/form-data">
                        <input type="hidden" name="seller_id" id="seller_id">
                        <?php
                        if (!empty($client)):
                            ?>
                            <input type="hidden" name="client_id" id="client_id"
                                   value="<?= $client->client_id ?>">
                        <?php
                        endif;
                        ?>
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="seller-name">Nome</label>
                                    <input type="text" id="seller-name" class="form-control"
                                           name="seller-name" placeholder="Nome" maxlength="250" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="seller_role">Cargo / Função</label>
                                    <input type="text" id="seller_role" class="form-control"
                                           name="seller_role" placeholder="Cargo / Função" maxlength="250">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="seller-email">Email</label>
                                    <input type="email" id="seller-email" class="form-control"
                                           name="seller-email" placeholder="Email" maxlength="250" >
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="seller-cell">Celular</label>
                                    <input type="text" id="seller-cell" class="form-control"
                                           name="seller-cell" placeholder="Celular" maxlength="250" >
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="seller-contact">Telefone</label>
                                    <input type="text" id="seller-contact" class="form-control"
                                           name="seller-contact" placeholder="Telefone" maxlength="250" >
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="seller-others">Outros</label>
                                    <input type="text" id="seller-others" class="form-control"
                                           name="seller-others" placeholder="Outros" maxlength="250" >
                                </div>
                            </div>
                            <div class="col-12 mt-4 d-flex justify-content-end">
                                <button type="submit" id="seller-submit" class="btn btn-primary me-1 mb-1">Salvar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $v->start("scripts"); ?>
    <script src="<?= url_views("panel/_js/client_form.js"); ?>"></script>
<?php $v->end(); ?>