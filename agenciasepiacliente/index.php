<?php

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router(URL_BASE);

$router->namespace("App\Controllers");
$router->group(null);

//Auth Group
$router->get("/", "Main:auth");

$router->post("/auth-token", "Main:authToken");
$router->post("/auth-validation", "Main:authValidation");
//Auth Group

//Panel Group
$router->group("painel");
$router->get("/", "Panel:home");
$router->get("/clientes", "Panel:client");
$router->get("/publicacoes", "Panel:publication");
$router->get("/publicacoes/{id}", "Panel:publication");
$router->get("/anuncios", "Panel:ads");
$router->get("/usuarios", "Panel:access");
$router->get("/mensagens", "Panel:messages");
$router->get("/agenda", "Panel:schedule");
$router->get("/sair", "Panel:logout");

$router->post("/salvar-cliente", "Panel:saveClient");
$router->post("/editar-cliente", "Panel:loadClient");

$router->post("/salvar-publicacao", "Panel:savePublication");
$router->post("/editar-publicacoes", "Panel:loadPublications");
$router->post("/deletar-publicacao", "Panel:deletePublications");
$router->post("/alterar-publicacao", "Panel:changePublications");
$router->post("/todas-publicacoes", "Panel:allPublications");
$router->post("/buscar-publicacoes", "Panel:slidePublication");

$router->post("/salvar-anuncios", "Panel:saveAds");
$router->post("/editar-anuncio", "Panel:loadAds");
$router->post("/deletar-anuncio", "Panel:deleteAds");
$router->post("/alterar-anuncio", "Panel:changeAds");
$router->post("/todas-anuncios", "Panel:allAds");

$router->post("/salvar-usuario", "Panel:saveAccess");
$router->post("/editar-usuario", "Panel:loadAccess");
$router->post("/update-usuario", "Panel:updateAccess");

$router->post("/todas-conversas", "Panel:allChats");
$router->post("/carregar-conversas", "Panel:loadChat");
$router->post("/enviar-chat", "Panel:sendChat");
$router->post("/novas-conversas", "Panel:newMessages");


$router->post("/agenda-cliente", "Panel:clientSchedule");
//Panel Group

//Clients Group
$router->group("cliente");
$router->get("/", "Clients:home");
$router->get("/anuncios", "Clients:ads");
$router->get("/agenda", "Clients:schedule");
$router->get("/mensagens", "Clients:messages");
$router->get("/sair", "Clients:logout");

$router->post("/post-aprovado", "Clients:statusPublication");
$router->post("/atualizar-copy", "Clients:changeCopy");
$router->post("/fragmento-publicacao", "Clients:fragmentPublication");
$router->post("/buscar-publicacoes", "Clients:slidePublication");
$router->post("/editar-publicacoes", "Clients:loadPublications");

$router->post("/fragmento-ads", "Clients:fragmentAds");
$router->post("/ads-aprovado", "Clients:statusAds");
$router->post("/atualizar-ads", "Clients:changeAds");

$router->post("/enviar-chat", "Clients:sendChat");
$router->post("/carregar-chat", "Clients:loadChat");

$router->post("/mensagens", "Clients:tableMessages");

$router->post("/agenda-cliente", "Clients:clientSchedule");
//Clients Group

//Compress Group
$router->group("editar-imagens");
$router->get("/", "Compress:home");
$router->get("/sair", "Compress:logout");

$router->post("/enviar-imagem", "Compress:sendFiles");
//Compress Group


//Tables Group
$router->group("tabela");
$router->post("/clientes", "Tables:clients");
$router->post("/usuarios", "Tables:users");
$router->post("/home", "Tables:home");
//Table Group


//$router->group("api")->namespace("App\Api");


$router->group("ops");
$router->get("/{errcode}", "Main:error");

$router->dispatch();

if ($router->error()) {
    $router->redirect("/ops/{$router->error()}");
}