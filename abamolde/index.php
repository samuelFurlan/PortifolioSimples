<?php

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router(URL_BASE);

$router->namespace("App\Controllers");
$router->group(null);

//Auth Group
$router->get("/", "Access:auth");
$router->post("/auth-validation", "Access:authValidation");
//Auth Group

//Panel Group
$router->get("/dashboard", "Panel:dashboard");

/**
 * Get Group
 * Get Views from Controllers
 */
$router->get("/clientes", "Panel:client_all");
$router->get("/novo-cliente", "Panel:client_new");
$router->get("/cliente/{id}", "Panel:client_edit");

$router->get("/novo-pedido", "Panel:new_request");
$router->get("/todos-pedidos", "Panel:all_requests");
$router->get("/pedido/{id}", "Panel:edit_request");
$router->get("/imprimir-pedido/{id}", "Panel:print_request");

$router->get("/compras/fornecedores", "Purchases:providers");
$router->get("/compras/nova", "Purchases:new_purchase");
$router->get("/compras/acompanhar", "Purchases:status_purchase");
$router->get("/compras/compra/{id}", "Purchases:edit_purchase");
$router->get("/compras/imprimir-compra/{id}", "Purchases:print_purchase");

$router->get("/almoxarifado/controle", "Warehouse:warehouse_control");
$router->get("/almoxarifado/entradas", "Warehouse:warehouse_entry");
$router->get("/almoxarifado/saidas", "Warehouse:warehouse_remove");
$router->get("/almoxarifado/estoque", "Warehouse:warehouse_status");

$router->get("/ferramentaria/controle", "Tooling:tooling_control");
$router->get("/ferramentaria/entradas", "Tooling:tooling_entry");
$router->get("/ferramentaria/saidas", "Tooling:tooling_remove");

$router->get("/usuarios", "Panel:employees");
$router->get("/cargos", "Panel:roles");
$router->get("/sair", "Panel:logout");

/**
 * Post Group
 * Send Clients Post to Controllers
 */
$router->post("/salvar-cliente", "Panel:client_save");
$router->post("/status-cliente", "Panel:client_status");
$router->post("/salvar-comercial", "Panel:seller_save");
$router->post("/status-comercial", "Panel:seller_status");
$router->post("/buscar-comercial", "Panel:seller_search");
$router->post("/editar-comercial", "Panel:seller_edit");

/**
 * Post Group
 * Send Requests Post to Controllers
 */
$router->post("/vincular-pedido", "Panel:request_link");
$router->post("/salvar-pedido", "Panel:request_save");
$router->post("/salvar-pedido-editado", "Panel:request_save_edited");
$router->post("/desativar-pedido", "Panel:request_disable");
$router->post("/remover-item", "Panel:item_remove");

/**
 * Post Group
 * Send Employee Post to Controllers
 */
$router->post("/salvar-colaborador", "Panel:employee_save");
$router->post("/status-colaborador", "Panel:employee_status");
$router->post("/editar-colaborador", "Panel:employee_edit");

$router->post("/salvar-cargo", "Panel:role_save");
$router->post("/status-cargos", "Panel:role_status");
$router->post("/editar-cargos", "Panel:role_edit");


/**
 * Post Group
 * Send Providers Post to Controllers
 */
$router->post("/compras/salvar-fornecedor", "Purchases:provider_save");
$router->post("/compras/carregar-fornecedor", "Purchases:provider_edit");
$router->post("/compras/listar-fornecedor", "Purchases:provider_load");
$router->post("/compras/adicionar-categoria-fornecedor", "Purchases:category_save");
$router->post("/compras/carregar-categoria-fornecedor", "Purchases:category_edit");
$router->post("/compras/listar-categoria-fornecedor", "Purchases:category_load");
$router->post("/compras/adicionar-vendedor-fornecedor", "Purchases:seller_save");
$router->post("/compras/carregar-vendedor-fornecedor", "Purchases:seller_edit");
$router->post("/compras/listar-vendedor-fornecedor", "Purchases:seller_load");
$router->post("/compras/salvar-nova-compra", "Purchases:purchase_save");
$router->post("/compras/salvar-edit-compra", "Purchases:purchase_edit");
$router->post("/compras/remover-item-compra", "Purchases:item_remove");
$router->post("/compras/carregar-orcamento", "Purchases:load_budget");

/**
 * Post Group
 * Send Warehouse Post to Controllers
 */
$router->post("/almoxarifado/salvar-produto-almoxarifado", "Warehouse:product_save");
$router->post("/almoxarifado/editar-produto-almoxarifado", "Warehouse:product_edit");
$router->post("/almoxarifado/adicionar-unidade", "Warehouse:unity_save");
$router->post("/almoxarifado/carregar-unidade", "Warehouse:unity_edit");
$router->post("/almoxarifado/listar-unidade", "Warehouse:unity_load");
$router->post("/almoxarifado/adicionar-produto-almoxarifado", "Warehouse:entry_save");
$router->post("/almoxarifado/adicionar-compra-almoxarifado", "Warehouse:entry_purchase");
$router->post("/almoxarifado/remover-produto-almoxarifado", "Warehouse:remove_save");
$router->post("/almoxarifado/adicionar-categoria-almoxarifado", "Warehouse:category_save");
$router->post("/almoxarifado/carregar-categoria-almoxarifado", "Warehouse:category_edit");
$router->post("/almoxarifado/carregar-produto-almoxarifado", "Warehouse:product_load");

/**
 * Post Group
 * Send Tooling Post to Controllers
 */
//$router->post("/ferramentaria/salvar-produto-ferramentaria", "Tooling:tooling_save");
$router->post("/ferramentaria/editar-produto-ferramentaria", "Tooling:tooling_edit");
$router->post("/ferramentaria/status-produto-ferramentaria", "Tooling:tooling_status");
$router->post("/ferramentaria/adicionar-produto-ferramentaria", "Tooling:entry_save");
$router->post("/ferramentaria/remover-produto-ferramentaria", "Tooling:remove_save");
$router->post("/ferramentaria/enviar-ferramentaria", "Tooling:tooling_save");
$router->post("/ferramentaria/carregar-observacoes", "Tooling:open_observations");
$router->post("/ferramentaria/carregar-codigobarras", "Tooling:open_barcode");
$router->post("/ferramentaria/carregar-ferramenta", "Tooling:open_tooling");





//Panel Group


//Tables Group
$router->group("tabelas");
$router->post("/clientes", "Tables:clients");
$router->post("/vendedores", "Tables:sellers");
$router->post("/pedidos-cliente", "Tables:client_requests");
$router->post("/pedidos", "Tables:requests");
$router->post("/colaboradores", "Tables:employees");
$router->post("/cargos", "Tables:roles");
$router->post("/fornecedores", "Tables:providers");
$router->post("/vendedor-categoria", "Tables:providers_category");
$router->post("/vendedor-fornecedor", "Tables:providers_sellers");
$router->post("/almoxarifado-unidade", "Tables:warehouse_unity");
$router->post("/almoxarifado-produtos", "Tables:warehouse_products");
$router->post("/almoxarifado-pesquisa-categoria", "Tables:warehouse_products_search");
$router->post("/almoxarifado-categoria", "Tables:warehouse_category");
$router->post("/ferramentaria-produtos", "Tables:tooling_products");
//Table Group


//$router->group("api")->namespace("App\Api");


$router->group("ops");
$router->get("/{errcode}", "Access:error");

$router->dispatch();

if ($router->error()) {
    $router->redirect("/ops/{$router->error()}");
}