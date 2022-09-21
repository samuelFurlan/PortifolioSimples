<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$table = "";
$total = 0;
if (isset($itens)){
    foreach ($itens as $iten) {
        $value = doubleval(substr($iten->itens_purchase_value_total,2));
        $total += $value;

        $table .= '
             <tr>
                <td style="width: 250px; height: 25px; text-align: center;">' . $iten->itemName()->itemName . '</td>
                <td style="width: 250px; height: 25px; text-align: center;">' . $iten->itens_purchase_amount . '</td>
                <td style="width: 250px; height: 25px; text-align: center;">' . $iten->itens_purchase_value_unit . '</td>
                <td style="width: 250px; height: 25px; text-align: center;">' . $iten->itens_purchase_value_total . '</td>
            </tr>
    ';
    }
}


if ($_SESSION["COMPANY_ID"] == 1) {
    $img_path = url_views("assets/_images/logo_aba.png");
} elseif ($_SESSION["COMPANY_ID"] == 2) {
    $img_path = url_views("assets/_images/logo_brp.png");
} else {
    $img_path = url_views("assets/_images/logo_aba.png");
}

switch ($purchase->purchase_status) {
    case 1:
        $status = "Aguardando Fornecedor";
        break;
    case 2:
        $status = "Em transporte";
        break;
    case 3:
        $status = "Entregue";
        break;
    case 4:
        $status = "Cancelado";
        break;
}
$provider_contact = json_decode($provider->provider_contact, true);

if ($purchase->purchase_estimate != ""){
    $estimate = date("d/m/Y", strtotime($purchase->purchase_estimate));
}else{
    $estimate = "A Combinar";
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
<title>Imprimir pedido de compra</title>
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
           <p>Pedido de compra N°' . $purchase->purchase_id . '</p>
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
                <td style="width: 700px; height: 25px;">Pedido: ' . $purchase->purchase_request  . '</td>
                <td style="width: 250px; height: 25px;">Status do pedido: ' . $status  . '</td>
            </tr>
            <tr>
                <td style="width: 700px; height: 25px;">Fornecedor: ' . $provider->provider_name . '</td>
                <td style="width: 250px; height: 25px;">CNPJ: ' . $provider->provider_cnpj . '</td>
            </tr>
            <tr>
                <td style="width: 700px; height: 25px;">E-mail: ' . $provider->provider_email . '</td>
                <td style="width: 250px; height: 25px;">Telefone: ' . $provider_contact["provider-contact"] . '</td>
            </tr>
            <tr>
                <td style="width: 700px; height: 25px;">Data de compra: ' . date("d/m/Y", strtotime($purchase->purchase_date)) . '</td>
                <td style="width: 250px; height: 25px;">Estimativa de entrega: ' . $estimate . '</td>
            </tr>
            </tbody>
          </table>
        </div>
        <hr/>
        <div class="container">
        <table>
            <thead>
                <tr>
                    <th scope="col">Item</th>
                    <th scope="col">Qtde.</th>
                    <th scope="col">Valor Unit.</th>
                    <th scope="col">Valor Total</th>
                </tr>
            </thead>
            <tbody>
                ' . $table . '
            </tbody>        
        </table>
        <table>
            <thead>
                <tr>    
                    <th style="width: 1800px; height: 25px;">Preço Total: '. number_format(floatval($total), "2", ",", ".") . '</th>
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

