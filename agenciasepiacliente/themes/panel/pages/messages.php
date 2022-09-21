<?php $v->layout("_theme_panel"); ?>
<?php $v->start("styles"); ?>
<link rel="stylesheet" type="text/css"
      href="<?= url("themes/panel/assets/css/chat.css"); ?>"/>
<?php $v->end(); ?>
<div class="page-heading">
    <!-- Basic Vertical form layout section start -->
    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-5">
                <div class="card">
                    <div class="card-header">
                        <h4>Todas Mensagens</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive chat-start">
                            <table class="table table-hover table-lg">
                                <tbody id="newMessages"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-7" id="divMessages">
                <div class="card">
                    <div class="card-header">
                        <div class="media d-flex align-items-center">
                            <div class="avatar me-3">
                                <img id="imgClient"
                                     src="<?= url("themes/_assets/_images/defaults/default-avatar.jpg"); ?>">
                            </div>
                            <div class="name flex-grow-1">
                                <h6 id="nameClient" class="mb-0">Cliente 1</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-4 bg-grey chat-start">
                        <div class="chat-content"></div>
                    </div>
                    <div class="card-footer">
                        <textarea class="form-control Input_field"  placeholder="Digite sua mensagem..."></textarea>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $v->start("scripts"); ?>
<script src="<?= url("themes/panel/assets/js/messages.js"); ?>"></script>
<?php $v->end(); ?>
