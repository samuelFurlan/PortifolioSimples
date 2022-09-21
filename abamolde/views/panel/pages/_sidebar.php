<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="<?= url("dashboard") ?>">
                        <img src="<?= url_views($_SESSION["COMPANY_LOGO"]) ?>" alt="Logo" srcset="">
                    </a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="fal fa-times-circle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-item" id="dashboard">
                    <a href="<?= url("dashboard") ?>" class='sidebar-link'>
                        <i class="fal fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <?php
                if ($_SESSION["role_permissions"]->request):
                ?>
                <li class="sidebar-item  has-sub" id="requests">
                    <a href="<?= url() ?>" class='sidebar-link'>
                        <i class="fal fa-file-invoice-dollar"></i>
                        <span>Pedidos / Orçamentos</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item" id="clients">
                            <a href="<?= url("clientes") ?>">Clientes</a>
                        </li>
                        <li class="submenu-item " id="new_request">
                            <a href="<?= url("novo-pedido") ?>">Novo</a>
                        </li>
                        <li class="submenu-item" id="all_requests">
                            <a href="<?= url("todos-pedidos") ?>">Todos</a>
                        </li>
                    </ul>
                </li>
                <?php
                endif;
                if ($_SESSION["role_permissions"]->purchases):
                ?>
                    <li class="sidebar-item  has-sub" id="catalog">
                        <a href="<?= url() ?>" class='sidebar-link'>
                            <i class="fal fa-book"></i>
                            <span>Catálogo</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item " id="products_catalog">
                                <a href="<?= url("almoxarifado/controle") ?>">Produtos</a>
                            </li>
                        </ul>
                    </li>
                <li class="sidebar-item  has-sub" id="purchases">
                    <a href="<?= url() ?>" class='sidebar-link'>
                        <i class="fal fa-receipt"></i>
                        <span>Compras</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item " id="providers">
                            <a href="<?= url("compras/fornecedores") ?>">Fornecedores</a>
                        </li>
                        <li class="submenu-item " id="new_purchase">
                            <a href="<?= url("compras/nova") ?>">Nova Compra</a>
                        </li>
                        <li class="submenu-item" id="purchase_status">
                            <a href="<?= url("compras/acompanhar") ?>">Acompanhar</a>
                        </li>
                    </ul>
                </li>
                <?php
                endif;
                if ($_SESSION["role_permissions"]->warehouse):
                ?>

                <li class="sidebar-item  has-sub" id="warehouse">
                    <a href="<?= url() ?>" class='sidebar-link'>
                        <i class="fal fa-boxes"></i>
                        <span>Almoxarifado</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item " id="status_warehouse">
                            <a href="<?= url("almoxarifado/estoque") ?>">Controle</a>
                        </li>
                        <li class="submenu-item" id="entry_warehouse">
                            <a href="<?= url("almoxarifado/entradas") ?>">Entradas</a>
                        </li>
                        <li class="submenu-item" id="remove_warehouse">
                            <a href="<?= url("almoxarifado/saidas") ?>">Saidas</a>
                        </li>
                    </ul>
                </li>
                <?php
                endif;
                if ($_SESSION["role_permissions"]->tooling):
                ?>
                <li class="sidebar-item  has-sub" id="tooling">
                    <a href="<?= url() ?>" class='sidebar-link'>
                        <i class="fal fa-tools"></i>
                        <span>Ferramentaria</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item " id="tooling_control">
                            <a href="<?= url("ferramentaria/controle") ?>">Ferramentas</a>
                        </li>
                        <li class="submenu-item" id="entry_tooling">
                            <a href="<?= url("ferramentaria/entradas") ?>">Devolução</a>
                        </li>
                        <li class="submenu-item" id="remove_tooling">
                            <a href="<?= url("ferramentaria/saidas") ?>">Retirada</a>
                        </li>

                    </ul>
                </li>
                <?php
                endif;
                if ($_SESSION["role_permissions"]->production):
                ?>
                <li class="sidebar-item  ">
                    <a href="<?= url() ?>" class='sidebar-link inProgress'>
                        <i class="fal fa-cogs"></i>
                        <span>Produção</span>
                    </a>
                </li>
                <?php
                endif;
                if ($_SESSION["role_permissions"]->configs):
                ?>
                <li class="sidebar-item  has-sub" id="settings">
                    <a href="<?= url() ?>" class='sidebar-link'>
                        <i class="fal fa-cogs"></i>
                        <span>Configurações</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item" id="roles">
                            <a href="<?= url("cargos") ?>">Cargos</a>
                        </li>
                        <li class="submenu-item" id="employees">
                            <a href="<?= url("usuarios") ?>">Usuários</a>
                        </li>
                        <li class="submenu-item inProgress">
                            <a href="<?= url() ?>">Email</a>
                        </li>
                        <li class="submenu-item inProgress">
                            <a href="<?= url() ?>">Outros</a>
                        </li>
                    </ul>
                </li>
                <?php
                endif;
                ?>

                <li class="sidebar-item">
                    <a href="<?= url("sair") ?>" class='sidebar-link'>
                        <i class="fal fa-door-open"></i>
                        <span>Sair</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>