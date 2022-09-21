<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$table = "";
foreach ($itens as $iten) {
    if ($iten->item_currency == "Euro") {
        $currency = "€$ ";
    } elseif ($iten->item_currency == "Dólar") {
        $currency = "U$ ";
    } else {
        $currency = "R$ ";
    }
    if (empty($iten->item_discount)) {
        $iten->item_discount = 0;
    }
    if (mb_strpos($iten->item_discount, "%")) {
        $discount = $iten->item_discount;
    } else {
        $discount = $currency . number_format(floatval($iten->item_discount), "2", ",", ".");
    }
    $table .= '
             <tr>
                <td style="width: 150px; height: 25px; text-align: center;">' . $iten->item_number . '</td>
                <td style="width: 150px; height: 25px; text-align: center;">' . $iten->item_amount . '</td>
                <td style="width: 150px; height: 25px; text-align: center;">' . $iten->item_draw_number . '</td>
                <td style="width: 150px; height: 25px; text-align: center;">' . $iten->item_description . '</td>
                <td style="width: 150px; height: 25px; text-align: center;">' . $currency . $iten->item_unit_price . '</td>
                <td style="width: 150px; height: 25px; text-align: center;">' . $discount . '</td>
                <td style="width: 150px; height: 25px; text-align: center;">' . $currency . $iten->item_final_price . '</td>
             </tr>
    ';
}

if ($_SESSION["COMPANY_ID"] == 1) {
    $img_path = url_views("assets/_images/logo_aba.png");
} elseif ($_SESSION["COMPANY_ID"] == 2) {
    $img_path = url_views("assets/_images/logo_brp.png");
} else {
    $img_path = url_views("assets/_images/logo_aba.png");
}

if ($request->request_situation == "Aprovado") {
    $type = "Pedido";
} else {
    $type = "Orçamento";
}


$client_contacts = json_decode($cliente->client_contact);
if (!empty($seller)) {
    $sellers_contacts = json_decode($seller->seller_contact, true);
    $seller_name = $seller->seller_name;
} else {
    $sellers_contacts["seller-contact"] = '';
    $seller_name = '';
}


$header = "
            <table>
                <tbody>
                    <tr>
                    <td><img src=" . $img_path . " width='100%'></td>
                    <td></td>
                    </tr>
                </tbody>        
            </table>";

$html = '
<html>
<head>
<title>Imprimir ' . $type . '</title>
    <style>
        @page  {
            margin: 10px 0;
        }
        body{
            margin: 0;
            padding: 0;
            font-family: "Open Sans", sans-serif;
            font-size: 12px;
        }
        .content{
            padding: 0 20px;
        }
        .container{
            margin-bottom: 10px;
        }
     
        
    </style>
</head>
<body>
<div class="content">
    <div class="section">
        <div class="container">
           <p>' . $type . ': ' . $request->request_number . '</p>
           <table>
            <tbody>
            <tr>
                <td rowspan="6"><img src="' . $img_path . '" width="200px"></td>
                <td style="width: 850px; text-align: right;">ABA MOLDE</td>
            </tr>
            <tr>
                <td style="width: 100%; text-align: right;">FERRAMENTARIA DE MOLDES PLÁSTICOS LTDA-EPP</td>
            </tr>
            <tr>
                <td style="width: 100%; text-align: right;">CNPJ: 02.399.403/0001-80</td>
            </tr>
            <tr>
                <td style="width: 100%; text-align: right;">Rua Serafina Milego Latorre 420</td>
            </tr>
            <tr>
                <td style="width: 100%; text-align: right;">Jd. Vera Cruz</td>
            </tr>
            <tr>
                <td style="width: 100%; text-align: right;">Sorocaba - SP</td>
            </tr>
            
            </tbody>
          </table>
        </div>
        <hr/>
        <div class="container">
          <table>
            <tbody>
            <tr>
                <td style="width: 500px; height: 25px;">Pedido: ' . $request->request_number . '</td>
                <td style="width: 250px; height: 25px;">Comercial: ' . $seller_name . '</td>
                <td style="width: 250px; height: 25px;">Telefone Comercial: ' . $sellers_contacts["seller-contact"] . '</td>
            </tr>
            <tr>
                <td style="width: 500px; height: 25px;">Cliente: ' . $cliente->client_name . '</td>
                <td style="width: 250px; height: 25px;">CNPJ: ' . $cliente->client_document . '</td>
            </tr>
            <tr>
                <td style="width: 500px; height: 25px;">Endereço: ' . $cliente->client_address . '</td>
                <td style="width: 250px; height: 25px;">Número: ' . $cliente->client_address_number . '</td>
            </tr>
            <tr>
                <td style="width: 500px; height: 25px;">Bairro: ' . $cliente->client_district . '</td>
                <td style="width: 250px; height: 25px;">Cidade: ' . $cliente->client_city . '</td>
                <td style="width: 250px; height: 25px;">Estado: ' . $cliente->client_state . '</td>
            </tr>
            <tr>
                <td style="width: 500px; height: 25px;">E-mail: ' . $cliente->client_mail . '</td>
                <td style="width: 250px; height: 25px;">Telefone: ' . $client_contacts->contact . '</td>
            </tr>
            <tr>
                <td style="width: 500px; height: 25px;">Data de criação: ' . date("d/m/Y", strtotime($request->created_at)) . '</td>
                <td style="width: 250px; height: 25px;">Data de emissão: ' . date("d/m/Y", strtotime($request->created_at)) . '</td>
            </tr>
            </tbody>
          </table>
        </div>
        <hr/>
        <div class="container">
        <table>
            <thead>
                <tr>
                    <th style="width: 100px; height: 25px;">Item</th>
                    <th style="width: 100px; height: 25px;">Peças</th>
                    <th style="width: 100px; height: 25px;">N° desenho</th>
                    <th style="width: 100px; height: 25px;">Descrição</th>
                    <th style="width: 100px; height: 25px;">Preço Unit.</th>
                    <th style="width: 100px; height: 25px;">Desc.</th>
                    <th style="width: 100px; height: 25px;">Preço total</th>
                </tr>
            </thead>
            <tbody>
                ' . $table . '
            </tbody>        
        </table>
        <table>
            <thead>
                <tr>
                    <th style="width: 200px; height: 25px;">Desconto Total: ' . $currency . number_format(floatval($request->request_general_item_discount), "2", ",", ".") . '</th>
                </tr>
                <tr>    
                    <th style="width: 200px; height: 25px;">Preço Total: ' . $currency . number_format(floatval($request->request_final_price), "2", ",", ".") . '</th>
                </tr>
            </thead>     
        </table>
        </div>        
    </div>
</div>
</body>
</html>';


//echo $html;
//die();
use Dompdf\Dompdf;
use Dompdf\Options;

require __DIR__ . "/../../../vendor/autoload.php";

$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper("A4", "landscape");
$dompdf->render();
$dompdf->stream("pedido.pdf", ["Attachment" => false]);

