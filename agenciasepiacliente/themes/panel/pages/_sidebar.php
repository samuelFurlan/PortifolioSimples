<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="<?= url("painel"); ?>"><img src="<?= url("themes/_assets/_images/logos/logo.png"); ?>" alt="Logo"
                                              srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>
                <li class="sidebar-item" id="home">
                    <a href="<?= url("painel"); ?>" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Início</span>
                    </a>
                </li>
                <li class="sidebar-item" id="clients">
                    <a href="<?= url("painel/clientes"); ?>" class='sidebar-link'>
                        <i class="bi bi-person-plus-fill"></i>
                        <span>Novo Cliente</span>
                    </a>
                </li>
                <li class="sidebar-item" id="publi">
                    <a href="<?= url("painel/publicacoes"); ?>" class='sidebar-link'>
                        <i class="bi bi bi-images"></i>
                        <span>Publicações</span>
                    </a>
                </li>
                <li class="sidebar-item" id="ads">
                    <a href="<?= url("painel/anuncios"); ?>" class='sidebar-link'>
                        <i class="bi bi-shop-window"></i>
                        <span>Anúncios</span>
                    </a>
                </li>
                <?php
                if ($_SESSION[md5("ACCESSPROFILE")] == 1):
                    ?>
                    <li class="sidebar-item" id="user">
                        <a href="<?= url("painel/usuarios"); ?>" class='sidebar-link'>
                            <i class="bi bi-key-fill"></i>
                            <span>Usuários</span>
                        </a>
                    </li>
                <?php
                endif;
                ?>
                <li class="sidebar-item" id="menuMessages">
                    <a href="<?= url("painel/mensagens"); ?>" class='sidebar-link'>
                        <i class="bi bi-chat-dots-fill"></i>
                        <span>Mensagens <item style="background-color: #5900b2" class="badge" id="newMessagesNotifications"></item></span>
                    </a>
                </li>
                <li class="sidebar-item" id="menuSchedule">
                    <a href="<?= url("painel/agenda"); ?>" class='sidebar-link'>
                        <i class="bi bi-calendar2-range-fill"></i>
                        <span>Agenda</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="<?= url("painel/sair"); ?>" class='sidebar-link'>
                        <i class="bi bi-box-arrow-in-left"></i>
                        <span>Sair</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>