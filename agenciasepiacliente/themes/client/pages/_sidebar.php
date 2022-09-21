<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="<?= url("cliente"); ?>">
                        <img src="<?= url("themes/_assets/_images/logos/logo.png"); ?>" alt="Logo">
                    </a>
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
                    <a href="<?= url("cliente"); ?>" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Publicações</span>
                    </a>
                </li>
                <li class="sidebar-item" id="ads">
                    <a href="<?= url("cliente/anuncios"); ?>" class='sidebar-link'>
                        <i class="bi bi-person-plus-fill"></i>
                        <span>Anúncios</span>
                    </a>
                </li>
                <li class="sidebar-item" id="menuSchedule">
                    <a href="<?= url("cliente/agenda"); ?>" class='sidebar-link'>
                        <i class="bi bi-calendar2-range-fill"></i>
                        <span>Agenda</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="<?= url("cliente/sair"); ?>" class='sidebar-link'>
                        <i class="bi bi-box-arrow-in-left"></i>
                        <span>Sair</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>